# Cool Kids Network - WordPress Plugin
## Introduction
**Cool Kids Network** is a custom WordPress plugin designed to manage user registration and assign custom roles. The plugin automatically creates a character for registered users and offers different levels of access based on user roles.

This project follows several key **User Stories** and implements a REST API for role management, supporting functionalities like assigning roles via email or by the user's first and last names.

## Features
- User Registration: Anonymous users can register and receive an auto-generated character (name, country, email).
- Role Management: Users are assigned specific roles based on their permissions:
  - Cool Kid: Default role assigned to all new users.
  - Cooler Kid: Can view the name and country of all users.
  - Coolest Kid: Can view additional sensitive information like email and role.
- REST API: Administrators can change user roles via a secure API, either using the user’s email or their first and last name.
