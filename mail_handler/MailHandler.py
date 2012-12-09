#!/usr/bin/python

import MySQLdb as mdb
import smtplib
import string
import sys
import time

from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

import Config

print "Starting up."

# Loop 11 times with 5 second breaks so the script can be executed every minute
i = 11
while i > 0:
	con = mdb.connect(Config.MYSQL_HOSTNAME, Config.MYSQL_USERNAME, Config.MYSQL_PASSWORD, Config.MYSQL_DATABASE)

	with con:
		cur = con.cursor()
		cur.execute("SELECT `id`, `to`, `subject`, `body` FROM `emails` WHERE `sent` IS NULL")
		rows = cur.fetchall()
		print "Need to send %d emails" % len(rows)
		server = smtplib.SMTP(Config.EMAIL_HOST, Config.EMAIL_PORT)
		server.starttls()
		server.login(Config.EMAIL_USERNAME, Config.EMAIL_PASSWORD)
		for row in rows:
			(ID, TO, SUBJECT, BODY) = row
			print "Sending email to %s" % TO
			msg = MIMEMultipart('alternative')
			msg['Subject'] = SUBJECT
			msg['From'] = Config.EMAIL_FROM
			msg['To'] = TO
			part1 = MIMEText('', 'plain')
			part2 = MIMEText(BODY, 'html')
			msg.attach(part1)
			msg.attach(part2)
			server.sendmail(Config.EMAIL_FROM, TO, msg.as_string())
			print "Email sent."
			UPDATE_SQL = "UPDATE `emails` SET `sent`=NOW() WHERE `id`='%s' LIMIT 1" % ID
			cur.execute(UPDATE_SQL)
			print "Record updated."
		if server:
			server.close()

	if con:
		con.close()

	i = i - 1
	time.sleep(5)

print "Shutting down."
