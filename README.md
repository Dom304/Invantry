# Invantry

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Sass](https://img.shields.io/badge/Sass-CC6699?style=for-the-badge&logo=sass&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white)

A one-stop e-commerce web application.


## Table of Contents

- [Project Name](#project-name)
  - [Table of Contents](#table-of-contents)
  - [About the Project](#about-the-project)
  - [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Dependencies](#dependecies)
    - [Installation](#installation)
    - [Docker/Database Setup](#dockerdatabase-setup)
  - [License](#license)
  - [Acknowledgments](#acknowledgments)

## About the Project

Invantry is a web application designed to simplify online store management and sales for small to medium-sized business owners looking for a simple way into the online marketplace. This application also provides a seamless shopping experience for consumers looking to find the best deals on any items they look for through use of the following features:

- Store Browsing
- Price Comparison
- Collections Feature: Allows buyers to create themed collections of items, similar to playlists in music apps.


## Getting Started

Explain how to get started with your project, including any prerequisites and installation steps.

### Prerequisites

- PHP 7.4+
- Composer 2.5.4+
- npm 

### Dependencies

List the main dependencies and libraries used in your project. You can include links to their official websites or repositories.

- **Laravel**: [https://laravel.com/](https://laravel.com/)
- **Vue.js**: [https://vuejs.org/](https://vuejs.org/)
- **Bootstrap**: [https://getbootstrap.com/](https://getbootstrap.com/)
- **Vue Prime**: [https://primevue.org/installation/](https://primevue.org/installation/)
- **Fort Awesome**: [https://fortawesome.com/](https://fortawesome.com/)

### Installation

```bash
# Example installation commands
git clone https://github.com/Dom304/Invantry.git
cd Invantry
npm install
cp .env.example .env
```

### Docker/Database Setup

If you prefer to use Docker for setting up the SQL database, follow these steps:

1. Install Docker on your system if you haven't already. You can download it from [https://www.docker.com/get-started](https://www.docker.com/get-started).

2. In the project directory, locate the `docker-compose.yml` file and modify the environment variables as needed for your database setup.

3. Run the following commands to start up the docker container:

```bash
docker-compose up -d
```

4. To create the database tables use the following command:
```bash
php artisan migrate
```

## License

This repository is licensed under the [MIT](https://github.com/alsiam/web-projects/blob/main/LICENSE).

[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/alsiam/web-projects/blob/master/LICENSE)

## Acknownlegment

This project was created created by Hector Rodriguez, Alec Droegemeier, Alexander Wesley and Dominique Simmons for the our Senior Capsstone project at The University of North Carolina at Greensboro, 2023.
