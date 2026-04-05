# user-login-system

## Description

This is a **secure user authentication system** built with **PHP** and **MySQL**, allowing users to **sign up, log in, and log out**. It incorporates essential security features like **password hashing, CSRF protection, session management, and optional "Remember Me" functionality**.

The system is designed for learning purposes and can serve as a foundation for any web project that requires user authentication.

---

## Features

* **User Signup**: Users can create an account with username, email, and password.
* **Password Security**: Passwords are securely hashed using `password_hash()` before storing in the database.
* **Login**: Users can log in using their **username** or **email**.
* **Session Management**: After login, a secure session is created to keep the user logged in.
* **"Remember Me" Functionality**: Users can stay logged in even after closing the browser (optional, using secure tokens).
* **CSRF Protection**: Forms include CSRF tokens to prevent cross-site request forgery attacks.
* **Validation**: Input validation for username, email, and password strength.
* **Logout**: Securely destroys sessions and clears tokens when users log out.

---

## Technologies Used

* **Frontend**: HTML, CSS, JavaScript
* **Backend**: PHP (with PDO for database access)
* **Database**: MySQL
* **Security Features**:

  * Password hashing
  * CSRF tokens
  * Session regeneration
  * HttpOnly cookies

---

## Installation / Usage

1. **Clone the repository**:

```bash
git clone https://github.com/yourusername/user-login-system.git
cd user-login-system
```

2. **Set up the database**:

   * Create a database named `user_login` (or any name you prefer).
   * Import the SQL schema (if you have one) or manually create a table `user_info`:

```sql
CREATE TABLE user_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(255)
);
```

3. **Update database credentials in `config.php`**:

```php
$pdo = new PDO(
    "mysql:host=localhost;dbname=user_login;charset=utf8mb4",
    "your_db_user",
    "your_db_password"
);
```

4. **Run the project**:

   * Place the files in your `htdocs` (XAMPP) or equivalent web server folder.
   * Open the project in your browser:
     `http://localhost/proj/logInPg/signup.php`

---

## Folder Structure

```
proj/
│
├── signup.php       # User registration page
├── login.php        # User login page
├── logout.php       # Log out and clear session
├── config.php       # Database connection and session config
├── functions.php    # Helper functions (e.g., message display)
├── style.css        # Styling for forms
├── loginInfo.js     # Optional JS validation or enhancements
└── signing.js       # Optional JS for signup/login form
```

---

## Security Considerations

* Use **HTTPS** in production to secure data in transit.
* Always sanitize and validate user input.
* Make sure `config.php` is not publicly accessible.

---

## Future Improvements

* Add **email verification** on signup.
* Implement **password reset via email**.
* Add **user profile management**.
* Integrate **OAuth login** (Google, GitHub, etc.).

---

## Author

**Amna Khan** – Student / Web Developer

---



Do you want me to make that version too?

