

---

# User Login System 

## Description

This is a **secure user login system** built with **PHP, MySQL, HTML, CSS, and JavaScript**. It allows users to **register, log in, and log out** safely. The project emphasizes **security best practices**, making it a strong learning resource and a solid foundation for web applications requiring authentication.

---

## Security Features

### 1. Password Security

* **Passwords are never stored in plain text.**
* Uses PHP’s `password_hash()` function with **bcrypt** to hash passwords before storing them in the database.
* During login, `password_verify()` is used to compare the entered password with the stored hash.

```php
// Example:
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
```

---

### 2. Input Validation & Sanitization

* All form inputs (username, email, password) are **validated on both client-side and server-side**.
* Prevents common attacks like **SQL Injection** and **XSS**.
* Uses prepared statements with PDO:

```php
$stmt = $pdo->prepare("SELECT * FROM user_info WHERE email = ?");
$stmt->execute([$email]);
```

---

### 3. Session Management

* **Secure sessions** are started at login to keep users authenticated.
* Uses `session_regenerate_id()` after login to prevent **session fixation attacks**.
* Sessions are destroyed securely on logout:

```php
session_unset();
session_destroy();
```

---

### 4. CSRF Protection

* Forms include **CSRF tokens** to prevent **Cross-Site Request Forgery**.
* Tokens are generated per session and validated on form submission.

```php
// Generate token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
```

---

### 5. Remember Me Functionality (Optional)

* Users can stay logged in even after closing the browser.
* Uses **secure, random tokens** stored in the database and in an **HttpOnly cookie**.
* Tokens are regenerated and verified on every login to prevent misuse.

---

### 6. HTTPS & Cookie Security

* Cookies (for sessions and “remember me”) are set with **HttpOnly** and **Secure** flags.
* Encourages deployment with **HTTPS** to encrypt data in transit.

```php
setcookie('remember', $token, time() + (86400 * 30), "/", "", true, true);
```

---

### 7. Error Handling & Messages

* Generic error messages are displayed to avoid leaking information.
* No sensitive data (like passwords) is revealed on failed login or signup attempts.

---

### 8. Database Security

* Uses **prepared statements** to avoid SQL injection.
* Keeps database credentials in a separate `config.php` file.
* Password hashes and tokens are stored securely.

---

## Features

* ✅ Signup with username, email, password
* ✅ Secure login via username/email
* ✅ Session management with regeneration
* ✅ Optional “Remember Me”
* ✅ CSRF-protected forms
* ✅ Input validation & sanitization
* ✅ Secure logout

---

## Technologies Used

* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP (PDO)
* **Database:** MySQL
* **Security:** Password hashing, CSRF tokens, session regeneration, HttpOnly cookies

---

## Installation

1. Clone the repo:

```bash
git clone https://github.com/yourusername/user-login-system.git
cd user-login-system
```

2. Set up the MySQL database:

```sql
CREATE TABLE user_info (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(255)
);
```

3. Update `config.php` with your database credentials.

4. Open in browser using a local server:
   `http://localhost/proj/logInPg/signup.php`

---

## Future Security Improvements

* Email verification on signup
* Password reset via email
* Rate-limiting login attempts
* Two-factor authentication (2FA)
* OAuth login (Google, GitHub)

---

## Author

**Amna Khan** – Student / Web Developer


Do you want me to do that?
