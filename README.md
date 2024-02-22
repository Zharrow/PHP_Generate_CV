# VOLT <img src="src/logo.svg">

![PHP](https://a11ybadges.com/badge?logo=php) ![Laragon](https://a11ybadges.com/badge?logo=laragon) ![MySQL](https://a11ybadges.com/badge?logo=mysql) ![Puppeteer](https://a11ybadges.com/badge?logo=puppeteer)

Web Application
🚀️ Generate CV online

`HOW TO RUN THIS APP`

- **Install Laragon** [here](https://laragon.org/download/)
- **Clone** this repository
- **Copy paste** this file **into** your Laragon files (must be at **C:\laragon**) and **replace 'www'** file by this repository
- **Launch Laragon** and **start the server**
- **Open Laragon database** and **import the sql** database (www/sql/setup-bdd.sql)
- Open your browser at localhost or 127.0.0.1

*You're now into the app* **- Well done !**

---

**PROJECT DATABASE**


| Users                  | Studies          | Experiences           | Skills           | Hobbies          |
| ------------------------ | ------------------ | ----------------------- | ------------------ | ------------------ |
| **<span style='color:blue'>UserID (PK)</span>**       | **StudyID (PK)** | **ExperienceID (PK)** | **SkillID (PK)** | **HobbyID (PK)** |
| *lastname*               | *institution*      | *enterprise*            | *skill*            | *hobby*            |
| *firstname*              | *degree*           | *job*                   | *type*            | **user_id (FK)** |
| *email*                  | *domain*           | *describe*              | **user_id (FK)** | -------------    |
| *phone*                  | *date_start*       | *date_start*            | ------------    | -------------    |
| *pwd*                    | *date_end*         | *date_end*              | ------------     | -------------    |
| *place*                  | **user_id (FK)** | **user_id (FK)**      | ------------     | -------------    |
| *user_description*       | ------------     | -----------------     | ------------     | -------------    |
| *profil_picture*         | ------------     | -----------------     | ------------     | -------------    |
| **study_id (FK)**      | ------------     | -----------------     | ------------     | -------------    |
| **experience_id (FK)** | ------------     | -----------------     | ------------     | -------------    |
| **hobby_id (FK)**      | ------------     | -----------------     | ------------     | -------------    |
