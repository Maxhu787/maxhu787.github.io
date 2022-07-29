from urllib import request
import xml.etree.ElementTree as ET

url = 'http://py4e-data.dr-chuck.net/comments_1551315.xml'
print("Retrieving", url)
html = request.urlopen(url)
data = html.read()
print("Retrieved", len(data), "characters")

tree = ET.fromstring(data)
results = tree.findall('comments/comment')
icount = len(results)
isum = 0

for result in results:
    isum += float(result.find('count').text)
print(icount)
print(isum)
