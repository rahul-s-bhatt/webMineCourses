from bs4 import BeautifulSoup
import requests
import csv

baseUrl = "https://www.coursera.org"

skillset = input().split(" ")

per20Skills = "%20".join(skillset)

courseraUrl = "https://www.coursera.org/search?query=" + per20Skills

page = requests.get(courseraUrl)

soup = BeautifulSoup(page.text, 'html.parser')

found = soup.find("h2", {'class': "color-primary-text card-title headline-1-text"})

foundU = soup.find("a", {'class': "rc-DesktopSearchCard anchor-wrapper"})

found_all = soup.find_all("h2", {'class': "color-primary-text card-title headline-1-text"})
foundU_all = soup.find_all("a", {'class': "rc-DesktopSearchCard anchor-wrapper"})

dict_course = dict()

with open('course.csv', 'w+', newline='') as file:


	myFields = ['courseName', 'courseUrl']
	writer = csv.DictWriter(file, fieldnames=myFields)    
	writer.writeheader()
	
	for i in range(len(found_all)):
		
		# for course urls
		toUrl = foundU_all[i].get('href')
		courseUrl = baseUrl + toUrl

		# to store it in dictonary courseName -> courseUrl

		dict_course[found_all[i].text] = courseUrl

		writer.writerow({'courseName' : found_all[i].text, 'courseUrl': courseUrl})


print(dict_course)



# Example - COURSERA : https://www.coursera.org/search?query=advanced%20java&
# Example - edx		 : https://www.edx.org/course?search_query=java+programming
