#!/usr/bin/env python3
#coding: utf-8
import requests

WALLSMART_URL	= 'http://192.168.2.168/index.php/Rest/index'
USERNAME			= 'supernadine'
PASSWORD			= 'test'
SOURCE			= '88'

def main(args):
	global ZEPPELIN_URL, USERNAME, PASSWORD, SOURCE
	r = requests.post(WALLSMART_URL, json={'username': USERNAME, 'password': PASSWORD, 'source': SOURCE})
	print("Status code: "+str(r.status_code))
	print(r.content())
	print(r.json())

if(__name__ == '__main__'):
	import sys
	main(sys.argv)
