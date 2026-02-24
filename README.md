Here’s a clean, practical README you can use for your project.

---

# Money Tracker API

Simple REST API for user authentication, wallet management, and transaction tracking.

## Version

`1.0.0`

---

## Base URL

```
/api
```

---

## Health Check

### GET `/api/health`

Check if the API is running.

**Response**

```json
{
  "status": "ok"
}
```

---

## Authentication

### POST `/api/register`

Register a new user.

**Body**

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password"
}
```

---

### POST `/api/login`

Authenticate a user and receive an access token.

**Body**

```json
{
  "email": "john@example.com",
  "password": "password"
}
```

**Response**

```json
{
    "token": "3|uWm4dSCSPl0YgxFGq9LH367jt9Om4WNL0kUjxvmb6003b94c",
    "user": {
        "id": 1,
        "name": "sam",
        "email": "email@example.com",
        "email_verified_at": null,
        "created_at": "2026-02-23T22:27:50.000000Z",
        "updated_at": "2026-02-23T22:27:50.000000Z"
    }
}
```

---

## Profile

### GET `/api/profile`

Get the authenticated user’s profile.

**Headers**

```
Authorization: Bearer {token}
```

---

## Wallets

### POST `/api/wallet`

Create a new wallet.

**Headers**

```
Authorization: Bearer {token}
```

**Body**

```json
{
  "name": "Main Wallet",
  "description": "My main wallet"
}
```

---

### GET `/api/wallet`

List all wallets for the authenticated user.

**Headers**

```
Authorization: Bearer {token}
```

---

### GET `/api/wallet/{wallet}`

Get details of a specific wallet.

**Headers**

```
Authorization: Bearer {token}
```

---

## Transactions
- Transaction type can be either `income` or `expense`.
- 
### POST `/api/transactions`

Create a transaction.

**Headers**

```
Authorization: Bearer {token}
```

**Body**

```json
{
  "wallet_name": "Main Wallet",
  "amount": 500,
  "type": "income",
  "description": "Salary"
}
```

---

## Validation Rules

* `amount` must be positive (`min:1` or `min:0.01` if decimal).
* Authentication required for protected routes.
* Wallet must belong to the authenticated user.

---

## Tech Stack

* Laravel
* MySQL
* RESTful architecture
* Token-based authentication

---

## Running the Project

```bash
git clone https://github.com/SAMUELMUCHIRI/Money-Tracker-API
cd Money-Tracker-API
composer install
cp .env.example .env
```

### Create SQLite Database File

#### Linux
```bash
touch database/database.sqlite
```
#### Windows CMD 
```bash
type nul >  database/database.sqlite
```
#### Windows Powershell
```bash
New-Item database/database.sqlite -ItemType File
```
## Testing (WHILE RUNNING)

```bash
php artisan test
```


---

## Notes

* All responses are JSON.
* Protected routes require a valid Bearer token.


---
