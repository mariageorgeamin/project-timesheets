# Laravel 12 Project with Repository & Service Pattern

This project is built using **Laravel 12** and follows the **Repository Pattern with a Service Layer**.  
It includes **EAV (Entity-Attribute-Value) implementation**, **Laravel Passport authentication**,  
**dynamic filtering with operators**, and **RESTful API endpoints**.

---

## **🚀 Features**
- ✅ **User-Project Management** (Many-to-Many)
- ✅ **Timesheet Tracking** (One-to-Many)
- ✅ **EAV for Dynamic Project Attributes**
- ✅ **Flexible Filtering with `=`, `>`, `<`, `LIKE`**
- ✅ **Laravel Passport Authentication**
- ✅ **Repository & Service Pattern**

---

## **📌 1️⃣ Installation**

### Clone Repository
```
git clone https://github.com/mariageorgeamin/project-timesheets.git
cd your-repo-name
```

## **📌2️⃣ Install Dependencies**


### Install composer

```
composer install
```

## **📌3️⃣ Set Up Environment**

### Env files

```
cp .env.example .env
```

#### Update database credentials

### Run Migrations & Seeders

```
php artisan migrate --seed
```


### Install Laravel Passport

```
php artisan passport:install
```

### Generate Application Key

```
php artisan key:generate
```

### Start the Server
```
php artisan serve
```

## **📌4️⃣ Test credentials**
```
user@test.com
123456
```
