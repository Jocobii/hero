const passport = require("passport");
const localStrategy = require("passport-local").Strategy;
const pool = require("../database");
const helpers = require('./helpers');

passport.use('local.signin', new localStrategy({
  usernameField: 'username', //obteniendo el usuario del formulario
  passwordField: 'password',
  passReqToCallback: true
}, async (req, username, password, done) => {
 
  //consultado a la bd si existe el usuario
  const rows = await pool.query('SELECT * FROM users WHERE username = ?', [username]);
  console.log(rows);
  if (rows.length > 0) {
    // guardando el usuario que esta en el arrelo como objeto
    const user = rows[0];
    //comparando las contrasenas
    // primer parametro constrasena en texto plano (del formulario)
    //la contrasena cifrada de la bd
    const validPassword = await helpers.matchPassword(password, user.password); //devuelve un boleano
    console.log(validPassword);
    if (validPassword) {
      done(null, user, req.flash('success', 'Welcome' + user.username));
    } else {
      done(null, false, req.flash('message','Incorrect Password'));
    }
  }else{
    return done(null,false,req.flash('message','The username does not exits'));
  }
}));

passport.use(
  "local.signup",
  new localStrategy(
    {
      usernameField: "username",
      passwordField: "password",
      passReqToCallback: true,
    },
    async (req, username, password, done) => {
      const { fullname } = req.body;
      const newUser = {
        username,
        password,
        fullname,
      };
      newUser.password = await helpers.encrypPassword(password);
      const result = await pool.query('INSERT INTO users SET ?', [newUser]);
      newUser.id = result.insertId;
      return done(null, newUser);
    }
  )
);

//almacenando el usuario en una session
passport.serializeUser((user, done) => {
  done(null, user.id);
});

//obteniendo el usuario 
passport.deserializeUser(async (id, done) => {
  const rows = await pool.query('SELECT * FROM users WHERE id = ?', id);
  done(null, rows[0]);
});
