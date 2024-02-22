# **VOLT**

<img style="position:absolute;right:25px;top:25px" src="src/logo.svg" width="30"/>

![PHP](https://a11ybadges.com/badge?logo=php) ![Laragon](https://a11ybadges.com/badge?logo=laragon) ![MySQL](https://a11ybadges.com/badge?logo=mysql) ![Puppeteer](https://a11ybadges.com/badge?logo=puppeteer)

Web Application <br>
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
| *email*                  | *domain*           | *describe*              | **user_id (FK)** |     |
| *phone*                  | *date_start*       | *date_start*            |    |     |
| *pwd*                    | *date_end*         | *date_end*              |     |     |
| *place*                  | **user_id (FK)** | **user_id (FK)**      |     |     |
| *user_description*       |      |     |      |     |
| *profil_picture*         |      |     |      |     |
| **study_id (FK)**      |      |     |      |     |
| **experience_id (FK)** |      |     |      |     |
| **hobby_id (FK)**      |      |     |      |     |

---

### UX EXPERIENCE FIRST
``This application is focused on User Experience.``<br>
The user can modify and interact with all his data on the dashboard, then the data will be reported to the CVs. If he want to modify multiple CVs at the time, he just need to change the data on the dashboard<br>

``Exemple :`` You are working at a company since 2020. You're old CVs says you are still working there, but now you want to edit them to say you leaved. You can edit the end date on the dashboard and that will update all your CVs models.

---

### WHY PUPPETEER INSTEAD OF NATIVE PHP LIBRAIRY
I choose Puppeteer for exporting PHP to PDF because it takes modern CSS while native PHP librairy don't.
To be clear, I had no other choice till I wanted to make differents PDF export with very differentes styles to give the user more possibilities.