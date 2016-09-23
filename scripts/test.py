import base64
import os
import sys

try:
	f1 = open("/Users/xingang/webcam/01_20160922230145.jpg", "rb")
	content = f1.read()

	badEnd="-------part1-----"
	if  content.endswith(badEnd):
		content = content[0: (len(content) - len(badEnd))] + "==="
	content=base64.b64decode(content)
	f2 = open("/Users/xingang/webcam/01_20160922230145.jpg", "wb")
	f2.write(content)
	f2.close()
	
except Exception, e:
    print str(e)