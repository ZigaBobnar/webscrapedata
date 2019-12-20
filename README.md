# Webscrape data analyzer project
Web portal for displaying the data acquired by webscrapers in useful way. Built using Django.

## Requirements
- Python 3 (developed using 3.8)
- virtualenv (optional, allows you to install packages only into this project and export them into requirements using `pip freeze > requirements.txt`)

## Set up project
- Check out this project and cd into it
- Run `virtualenv venv --no-site-packages` to create virtual environment (you can replace venv with something else as long as it is not present in the current directory). The --no-site-packages options is used so the globally installed packages are not copied into virtualenv
- Run `source venv/bin/activate` (Linux) or `.\venv\Scripts\activate` (Windows, you might need to enable running PowerShell scripts)
- Install required packages using `pip install requirements.txt`
- Use `python manage.py runserver` to start development server
- Open `http://localhost:8000`

When you are done working with this project you can use `deactivate` command in order to exit the virtual environment. Always remember to activate the enviromnent again if you want to use it.
