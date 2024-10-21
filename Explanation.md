# Project Goal

The goal of the project **Cool Kids NetWork** is to implement a user registration and management system based
specific roles with the following rules :
- An anonymous user can register and receive a character.
- A registered user can log in and view their character information.
- Users with the **Cooler Kid** or **Coolest Kid** role can see other users' names and countries.
- Users with the Coolest Kid role can see sensitive information like email and role of other users.
- Admins can change user roles via a REST API.

# Technical details
For the needs of the project, we implemented a plugin that provides blocks allowing users to register, log in, and view the list of users when they have the necessary permissions.

## The Plugin Cool Kids Network Structure
The plugin is organized and modular structure, with a clear separation between the plugin's functionalities.
The plugin provide **Blocks**, **AJAX** and **REST API**.

`
.
├── cool-kids-network/                    # Plugin directory
├──── build                               # Blocks build
│──── classes                             # Classes files
│     ├── class-ckn-ajax-handler.php      # Manage request AJAX.
│     ├── class-ckn-rest-api.php          # Register and manage request REST API.
│     └── ...
│──── inc                   # list include files
│     ├── blocks.php        # Register Blocks server side.
│     ├── init.php          # Function to register custom wp roles
│     └── functions.php     # Function utils 
│──── src                   # Source block before build
│──── cool-kids-network.php # Plugin starter.
└── ...
`
## Key Functionalities and How They Work
### a) User Registration Block
- **Purpose**: Provides a block for anonymous users to register by submitting their email address.
- **How it works**:
  - The block renders a registration form that collects the user's email. 
  - Upon submission, the plugin sends an AJAX request to a custom handler which registers the user and assigns them a default role of Cool Kid.
  - The user is then automatically assigned a randomly generated character (first name, last name, country) using the randomuser.me API.

### b) Login Block
- **Purpose**: Allows registered users to log in with password "password"
- **How it works**:
  - The login block renders a form (using `wp_login_form`) where the user provides their email.
  - The system checks the email, and if the user exists, they are logged in.

### c) User list Block
- **Purpose**: Displays a list of users based on the current user's role.
- **How it works**:
  - On click button a AJAX request is send to retrieve list of users with the roles **Cool Kid** **Cooler Kid** and **Coolest Kid**
  - User with the role Cooler Kid or Coolest Kid can view a list of name and country of other users.
  - User With the role Coolest kid have enhanced access, allowing them to also view sensitive information like email and roles of other users.

### Role Management via REST API

The plugin provides a secure, custom REST API endpoint for administrators to change user roles. 
This API is security by the plugin **JWT Authentication for WP Rest API** 
to ensure that only authorized users can make changes.

- **Endpoint** : `wp-json/cool-kids-network/v1/user/edit_role`
- **Request parameters**: 
  - `email` (string): The email address of the user whose role needs to be updated.
  OR
  - `first_name` (string) and `last_name` (string): If the email is not provided, the user can be identified by their first and last name.
  - `new_role` (string) : The role to be assigned (e.g., cool_kid, cooler_kid, coolest_kid).
- **Security**:
  - The API is protected by a permission callback that checks if the current user has the capability to edit users (edit_users). 
  - Input data is sanitized and validated to ensure correct data is being processed.

## Technical choice

For this project, I used both AJAX and the WordPress REST API to handle different aspects of the plugin:
- **AJAX** : I chose to implement AJAX for user registration and listing users due to its simplicity. AJAX allows for fast, real-time actions without needing to reload the page, making the user experience smoother.
- **REST API** : For managing user roles, I opted for the WordPress REST API. This decision was driven by the need for better security. he REST API is more robust for handling operations like modifying user roles because it provides built-in security features, such as permission callbacks and nonce validation.