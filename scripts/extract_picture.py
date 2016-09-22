# Something in lines of http://stackoverflow.com/questions/348630/how-can-i-download-all-emails-with-attachments-from-gmail
# Make sure you have IMAP enabled in your gmail settings.
# Right now it won't download same file name twice even if their contents are different.

import email
import getpass, imaplib
import os
import sys
import glob
from shutil import copyfile

#detach_dir = '/Users/xingang/'
#web_dir = '/Users/xingang/Documents/up/ppcweb/web/swan/images/webcam'
detach_dir='/home/ubuntu'
web_dir='/var/www/html/swan/images/webcam'

def updateLatest(camId):
	webcam = glob.glob(detach_dir+'/'+'webcam'+'/' + camId + '_20*.jpg')
	if len(webcam) > 0 :
		webcam.sort(reverse=True)
		dest = web_dir + '/' + camId + '_latest.jpg'
		print webcam[0]
		print dest
		copyfile(webcam[0], dest)
		
    	

if 'webcam' not in os.listdir(detach_dir):
    os.mkdir(detach_dir +'/' + 'webcam')

userName = 'swan.dvr.monitor@gmail.com'
passwd = 'swan1257'
print 'Start'

try:
    imapSession = imaplib.IMAP4_SSL('imap.gmail.com')
    typ, accountDetails = imapSession.login(userName, passwd)
    if typ != 'OK':
        print 'Not able to sign in!'
        raise
    
    imapSession.select('[Gmail]/All Mail')
    typ, data = imapSession.search(None, '(UNSEEN)')
    if typ != 'OK':
        print 'Error searching Inbox.'
        raise
    
    # Iterating over all emails
    for msgId in data[0].split():
        typ, messageParts = imapSession.fetch(msgId, '(RFC822)')
        if typ != 'OK':
            print 'Error fetching mail.'
            raise

        emailBody = messageParts[0][1]
        mail = email.message_from_string(emailBody)
        for part in mail.walk():
            if part.get_content_maintype() == 'multipart':
                # print part.as_string()
                continue
            if part.get('Content-Disposition') is None:
                # print part.as_string()
                continue
            fileName = part.get_filename()

            if bool(fileName):
                filePath = os.path.join(detach_dir, 'webcam', fileName)
                if not os.path.isfile(filePath) :
                    print fileName
                    fp = open(filePath, 'wb')
                    fp.write(part.get_payload(decode=True))
                    fp.close()
    imapSession.close()
    imapSession.logout()
        	
    updateLatest('00')
    updateLatest('01')
    
except :
    print 'Not able to download all attachments.'
    

	    