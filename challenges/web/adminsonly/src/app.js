const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const fs = require('fs');
const { v4: uuidv4 } = require('uuid');
const sqlite3 = require('sqlite3').verbose();

const app = express();
const port = 3000;

// Generate a random secret for express-session
const sessionSecret = uuidv4();

// Connect to SQLite database
const db = new sqlite3.Database(':memory:'); // Use ":memory:" for an in-memory database

// Create a users table (replace with your actual schema)
db.serialize(() => {
  db.run("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, password TEXT)");
  db.run("INSERT INTO users (username, password) VALUES (?, ?)", 'admin', 'YouWillNeverGuessME!');
  db.run("INSERT INTO users (username, password) VALUES (?, ?)", 'stephen', 'stephen');
  db.run("INSERT INTO users (username, password) VALUES (?, ?)", 'micah', 'hellothere');
});

// EJS setup
app.set('view engine', 'ejs');
app.set('views', __dirname + '/views');

// Middleware
app.use(session({
  secret: sessionSecret,
  resave: true,
  saveUninitialized: true
}));

app.use(bodyParser.urlencoded({ extended: true }));

// Check if user is logged in middleware
const requireLogin = (req, res, next) => {
  if (!req.session.user) {
    res.redirect('/login');
  } else {
    next();
  }
};

// Routes
app.get('/', (req, res) => {
  res.redirect('/login');
});

app.get('/login', (req, res) => {
  res.render('login');
});

app.post('/login', (req, res) => {
  const { username, password } = req.body;

  // Check if the username and password match any user
  db.get(`SELECT * FROM users WHERE username = '${username}' AND password = '${password}'`, [], (err, user) => {
    if (user) {
      req.session.user = user;
      res.redirect('/admin');
    } else {
      res.redirect('/login');
    }
  });
});

app.get('/admin', requireLogin, (req, res) => {
  let flag = fs.readFileSync('flag.txt', 'utf8');

  // Fetch all users from the database
  db.all("SELECT * FROM users", (err, users) => {
    if (err) {
      console.error('Error fetching users from the database:', err);
      res.sendStatus(500);
      return;
    }

    res.render('admin', {
      flag,
      users,
      username: req.session.user.username
    });
  });
});

app.get('/logout', (req, res) => {
  req.session.destroy();
  res.redirect('/login');
});

// Start the server
app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
