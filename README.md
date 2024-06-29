# Schedule-Generation
This repository contains a project designed to generate schedules for presentations. It provides an intuitive interface for creating, managing, viewing, and downloading presentation schedules in different formats (PDF, Excel, Zip), making it ideal for various university events involving student activities.

The project was created by Yovana Bozhilov with contributions from Branka Stoyeva.

Further in this README file, I will present a brief documentation of the mentioned project, which can help the reader/user understand our system and its functionalities.

# Introduction
Regardless of whether it involves professional commitments, personal meetings, or recreational events, scheduling plays a key role in organizing our day. This documentation examines the process of generating a schedule for a specific event - presentations.

The scheduling process distinguishes between two roles - the user role, which involves using the schedule to review past and upcoming presentations and expressing interest in them, and the administrator role, responsible for managing events and updating the schedule content. In other words, the administrator is the person who adds and edits the schedule's content.

The system allows for registration for unregistered users and login for registered ones. Furthermore, it enables administrators to add and edit events in the schedule. On the other hand, users need the capability to view both upcoming and past presentations. Additionally, users should be able to mark presentations that interest them by selecting one of the options from a dropdown menu: "Considering attending", "Interesting", or "Might be interesting". Based on users' choices, the system generates a personalized schedule for them. Ultimately, users have the ability to print their personalized schedule in formats such as PDF, Excel, or archive.

As a result of designing such a system, users will have access to a personalized and optimized schedule, helping them plan their activities and time more effectively.

# Analysis and Solution Design
The application is based on the Model-View-Controller (MVC) architecture, which separates various functionalities and facilitates maintenance and scalability. Let's examine the following modules within our application:

**User Interface** (view folder)

The interface provides interaction for users with the system through HTML templates and static resources (CSS, JavaScript, images). Files available in this module include:

HTML and PHP files: add_presentation.php, edit_presentation.php, admin_main.php, main.php, register.html, login.html, guest.html, error.html. These files contain templates for visualizing different parts of the system.

Next, we have "assets" folder, which contains a "banners" folder with image ("mainBanner1.jpg") used in the main page of the system, a "js" folder with "validation.js" file, and "css" folder with "default.css" and "skeleton.css" files for application styles.

**Controllers** (controller folder)

Controllers receive requests from the interface, process them, and return results back to the view. They communicate with various PHP classes (model) and DAO (Data Access Object) for executing business logic. Files available in this module include:

AbstractController.php - Abstract class containing basic functionality inherited by other controllers.

UserController.php - Controls actions related to users, such as registration, login, viewing, and marking events.

AdminController.php - Controls actions related to administrators, such as adding and editing events.

PresentationController.php - Controls actions related to presentations, such as saving interests, generating a presentation table, and exporting the table.

**Models** (model folder)

Models represent data and the logic for manipulating that data. They define the structure of information and methods for accessing and modifying it. The following files are available:

Presentation.php - Model for representing information about presentations.

User.php - Model for users.

DAO folder (Data Access Object)

The DAO layer provides an abstraction for accessing the database, offering methods for storing, retrieving, and modifying data. Within this module, we have the following files:

PresentationDAO.php - DAO classes for managing data access for presentations.

UserDAO.php, AdminDAO.php - DAO classes for managing data access for users and administrators.

AbstractDAO.php - Class for common database operations, establishing the connection to the database itself.

IPresentationDAO.php, IUserDAO.php, IAdminDAO.php - Interfaces defining methods for interacting with the database.

**Database** (database folder)

The database stores all application data, including information about users, presentations, and their various aspects. This folder includes schedule_generation.sql file, which contains SQL script for generating the database structure.

Additionally, we have two more files in the main Schedule folder, which contains all of the other mentioned folders and files:

handleRequest.php, which processes requests from users and administrators, redirecting them to the respective controllers, and index.php, the main entry file of the system, which loads the initial page and handles initial requests. It redirects to different pages and executes specific commands for each functionality. These files act as a bridge between the controllers and the interface

# Used Technologies
As I said before, we aim for a three-tier architecture based on the MVC (Model-View-Controller) model.

The interface is built primarily using the currently widely-used HTML, CSS, and JavaScript. All user registration data, as well as information about various presentations, is stored in a database accessed through MySQL, directly installed via XAMPP. The application has been tested on an Apache server, which is also included in the XAMPP installation package.

The business logic is implemented using PHP. In the model part of the MVC model, the main classes for the system are created, and communication with the database is established. The validation of user registration information and restriction of their access to certain functionalities, depending on their type (user/administrator), is performed in this part. The controller part of the MVC model is responsible for retrieving and sending data to the presentation layer of the system.

# Installation, Settings, and DevOps
To properly use the application and take advantage of the functionalities it provides, the user must have the latest version of XAMPP installed on their local machine. This allows them to run an Apache server and MySQL database without the need to install other programs. Through phpMyAdmin, the necessary tables for the database can be created and edited. The project files must be placed in the specific XAMPP folder (htdocs). To launch the application in the browser, type "localhost" and the port number if it is different from 80.

Another way to access the system is by installing an Apache server that supports PHP and MySQL. The project should be located in the folder specified during the server setup (preferably named "localhost"), which should be directly accessible when entering "C:". To run the project, the server must be started, and in the browser, type the name of the folder containing the project and the port number if it is different from 80 (e.g., localhost:8080).

The logic for establishing a connection with the database is contained in the AbstractDao.php file. Thus, if corrections are needed, changes will be made only in this file. For generating PDF and Zip (archive) files, we used the commands wkhtmltopdf and tar. For configuring and installing the wkhtmltopdf command, we used this tutorial: https://www.youtube.com/watch?v=XX9nhxVF8Z4. A key element when using the command is to specify the exact path to its directory for it to be accessible. The wkhtmltopdf command is used to convert HTML to PDF. For archiving our table, we used the tar command, and to implement and study it, we used this tutorial: https://www.youtube.com/watch?v=29UdweXJThk&t=321s. It is also accessed by providing the full path to the directory where it is located to ensure successful localization.

# Future Expansion Opportunities
Opportunities for future expansion include the integration of additional functionalities such as automatic schedule updates, improving the interface's appearance, and expanding administration and analysis functionalities.
