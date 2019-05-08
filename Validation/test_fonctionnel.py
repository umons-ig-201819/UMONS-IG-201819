

from selenium import webdriver
import random
import sys
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC


from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import NoAlertPresentException
import unittest, time, re



def print_same_line(text):
    sys.stdout.write('\r')
    sys.stdout.flush()
    sys.stdout.write(text)
    sys.stdout.flush()


class Wallesmart:

    def __init__(self, username, password,datasource1,datasource2,new_data_source,lastname):
        self.username = username
        self.password = password
        self.datasource1 = datasource1
        self.datasource2 = datasource2
        self.lastname=lastname
        self.new_data_source=new_data_source

        self.driver = webdriver.Chrome()

    def closeBrowser(self):
        self.driver.close()

    def login(self):
        driver = self.driver
        driver.get("http://192.168.2.168/index.php/")
        time.sleep(2)
        #inscription
        register_button = driver.find_element_by_xpath("//a[@href='http://192.168.2.168/index.php/register']")
        register_button.click()
        time.sleep(2)
        
        
        # login
        login_button = driver.find_element_by_xpath("//a[@href='http://192.168.2.168/index.php/connection']")
        login_button.click()
        time.sleep(2)
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        user_name_elem = driver.find_element_by_xpath("//input[@name='username']")
        user_name_elem.clear()
        user_name_elem.send_keys(self.username)
        passworword_elem = driver.find_element_by_xpath("//input[@name='password']")
        passworword_elem.clear()
        passworword_elem.send_keys(self.password)
        passworword_elem.send_keys(Keys.RETURN)
        time.sleep(2)
        #try :
        #    if(driver.switch_to.alert):
        #        alert = driver.switch_to.alert
        #        WebDriverWait(driver, 3).until(EC.alert_is_present(),
        #                               'Timed out waiting for PA creation ' +
        #                               'confirmation popup to appear.')
        #        alert.accept()
        #        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        #except TimeoutException :
        #    print("no alert")

        time.sleep(2)
        profil_button = driver.find_element_by_xpath("//a[@href='http://192.168.2.168/index.php/profil']")
        profil_button.click()
        time.sleep(2)
        for i in range(1, 7):
            driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        time.sleep(2)

        #charger un exemple de database
        datasource_button = driver.find_element_by_xpath("//a[@href='http://192.168.2.168/index.php/datasource']")
        datasource_button.click()
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        datasource_elem = driver.find_element_by_xpath("//select[@name='datasource']")
        datasource_elem.click()
        datasource_elem.send_keys(self.datasource1)
        charger_elem = driver.find_element_by_xpath("//input[@name='action']")
        charger_elem.click()
        time.sleep(4)
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        time.sleep(4)  

        #deuxieme exemple pour charger la base
        datasource_elem = driver.find_element_by_xpath("//select[@name='datasource']")
        datasource_elem.click()
        datasource_elem.send_keys(self.datasource2)
        charger_elem = driver.find_element_by_xpath("//input[@name='action']")
        charger_elem.click()
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        time.sleep(4)

        #rechercher un utilisateur 
        driver.execute_script("window.scrollTo(1, document.body.scrollHeight);")
        search_button = driver.find_element_by_xpath("//a[@href='http://192.168.2.168/index.php/search/user']")
        search_button.click()
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        search_elem = driver.find_element_by_xpath("//input[@name='lastname']")
        search_elem.send_keys(self.lastname)
        envoyer = driver.find_element_by_xpath("//input[@name='action']")
        envoyer.click()
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")

        #charger
        charger_button = driver.find_element_by_xpath("//a[@href='http://192.168.2.168/index.php/datasource']")
        charger_button.click()
        time.sleep(3)
        ajouter = driver.find_element_by_xpath("//a[@href='http://192.168.2.168/index.php/datasource/addSource']")
        ajouter.click()
        select_button = driver.find_element_by_xpath("//input[@name='datafile']")
        #select_button.click()
        select_button.send_keys("/Users/aureliecools/Downloads/aurelie.csv");
        envoyer = driver.find_element_by_xpath("//input[@name='action']")
        envoyer.click()
        time.sleep(3)

        #the new file
        datasource_elem = driver.find_element_by_xpath("//select[@name='datasource']")
        datasource_elem.click()
        datasource_elem.send_keys(self.new_data_source)
        charger_elem = driver.find_element_by_xpath("//input[@name='action']")
        charger_elem.click()
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")

        time.sleep(4)




if __name__ == "__main__":

    username = "coooools"
    password = "obligatoire"
    datasource1 = "CSV exemple"
    datasource2 = "Access exemple"
    new_data_source = "aurelie.csv"
    lastname="MACHIN"

    ig = Wallesmart(username, password,datasource1,datasource2,new_data_source,lastname)
    ig.login()


    
