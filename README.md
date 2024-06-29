# Schedule-Generation
This repository contains a project designed to generate schedules for presentations. It provides an intuitive interface for creating, managing, viewing, and downloading presentation schedules in different formats (PDF, Excel, Zip), making it ideal for various university events involving student activities.

The project was created by Yovana Bozhilov with contributions from Branka Stoyeva.

# Introduction
Regardless of whether it involves professional commitments, personal meetings, or recreational events, scheduling plays a key role in organizing our day. This documentation examines the process of generating a schedule for a specific event - presentations.

The scheduling process distinguishes between two roles - the user role, which involves using the schedule to review past and upcoming presentations and expressing interest in them, and the administrator role, responsible for managing events and updating the schedule content. In other words, the administrator is the person who adds and edits the schedule's content.

The system allows for registration for unregistered users and login for registered ones. Furthermore, it enables administrators to add and edit events in the schedule. On the other hand, users need the capability to view both upcoming and past presentations. Additionally, users should be able to mark presentations that interest them by selecting one of the options from a dropdown menu: "Considering attending," "Interesting," or "Might be interesting." Based on users' choices, the system generates a personalized schedule for them. Ultimately, users have the ability to print their personalized schedule in formats such as PDF, Excel, or archive.

As a result of designing such a system, users will have access to a personalized and optimized schedule, helping them plan their activities and time more effectively.

# Used Technologies
In the development of version 1.0 of this system, we aim for a three-tier architecture based on the MVC (Model-View-Controller) model.

The interface is built primarily using the currently widely-used HTML, CSS, and JavaScript. All user registration data, as well as information about various presentations, is stored in a database accessed through MySQL, directly installed via XAMPP. The application has been tested on an Apache server, which is also included in the XAMPP installation package.

The business logic is implemented using PHP. In the model part of the MVC model, the main classes for the system are created, and communication with the database is established. The validation of user registration information and restriction of their access to certain functionalities, depending on their type (user/administrator), is performed in this part. The controller part of the MVC model is responsible for retrieving and sending data to the presentation layer of the system.

# Installation, Settings, and DevOps
To properly use the application and take advantage of the functionalities it provides, the user must have the latest version of XAMPP installed on their local machine. This allows them to run an Apache server and MySQL database without the need to install other programs. Through phpMyAdmin, the necessary tables for the database can be created and edited. The project files must be placed in the specific XAMPP folder (htdocs). To launch the application in the browser, type "localhost" and the port number if it is different from 80.

Another way to access the system is by installing an Apache server that supports PHP and MySQL. The project should be located in the folder specified during the server setup (preferably named "localhost"), which should be directly accessible when entering "C:". To run the project, the server must be started, and in the browser, type the name of the folder containing the project and the port number if it is different from 80 (e.g., localhost:8080).

The logic for establishing a connection with the database is contained in the AbstractDao.php file. Thus, if corrections are needed, changes will be made only in this file. For generating PDF and TAR (archive) files, we used the commands wkhtmltopdf and tar. For configuring and installing the wkhtmltopdf command, we used this tutorial: https://www.youtube.com/watch?v=XX9nhxVF8Z4. A key element when using the command is to specify the exact path to its directory for it to be accessible. The wkhtmltopdf command is used to convert HTML to PDF. For archiving our table, we used the tar command, and to implement and study it, we used this tutorial: https://www.youtube.com/watch?v=29UdweXJThk&t=321s. It is also accessed by providing the full path to the directory where it is located to ensure successful localization.

# Limitations and Future Expansion Opportunities
The schedule generation application has limitations in its functionality and interface. The use of a local Apache server and a basic HTML/CSS/JavaScript interface restricts scalability and expansion possibilities.

Opportunities for future expansion include the integration of additional functionalities such as automatic schedule updates, improving the interface's appearance, and expanding administration and analysis functionalities.
