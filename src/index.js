const express = require('express');
const morgan = require('morgan');
const exphbs = require('express-handlebars');
const request = require('request');
const path = require('path');
const flash  = require('connect-flash');
const { proppatch } = require('./routes');
const MySQLStore = require('express-mysql-session');
const {database} = require('../src/keys');
const passport = require('passport');
//initializations

/**
 * Inicializamos express
 */
const app = express();

/**
 * 1- Configuramos el puerto del servidor 
 * 2- Definimos la ruta de la carpeta donde estaran las vistas
 * 3- Configuramos Handlebars:
 * defaultLayout : Le definimos el archivo main en donde usualmente se utiliza para 
 * referenciar css, js, etc.
 * layoutsDir: le definimos la ruta donde se encuentra la carpeta layout (main.hbs)
 * partialsDir: le defnimos la ruta donde se encuentra la carpeta partials,
 * usualmente utilizada para poner vistas reutilizables como el menu, footer etc,
 * extname: le decimos que vamos abreviar la extension de .handlebars -> .hbs
 * helpers: le definimos la ruta donde se encuentran los helpers.
 */

//settings
app.set('port', process.env.PORT || 4000); // 1
app.set('views', path.join(__dirname, 'views')); // 2
app.engine('.hbs', exphbs({ // 3
    defaultLayout: 'main',
    layoutsDir: path.join(app.get('views'), 'layouts'),
    partialsDir: path.join(app.get('views'), 'partials'),
    extname: '.hbs',
    helpers: require('./lib/handlebars')
}));
app.set('view engine', '.hbs');

//Middlewares - Funciones que se ejecutan cada que envian una peticion

app.use(morgan('dev'));
app.use(express.urlencoded({ extended: false }));
app.use(express.json());
//inicializacion de passport
app.use(passport.initialize());
//passport funciona con una session 
app.use(passport.session());

//Global Variables
app.use((req, res, next) => {
    
    next();
});

//Routes

/**
 * Definimos los prefijos de las rutas con su respectiva referencia del archivo
 */
app.use(require('./routes'));
app.use(require('./routes/authentication'));
app.use('/colaborador',require('./routes/colaborador'));
app.use('/inventario',require('./routes/inventario'));
app.use('/modelo', require('./routes/modelo'));
app.use('/marca', require('./routes/marca'));
// cada vez que quieran utilizar las rutas de colaborador
//Tendran que poner primero /colaborador y despues la ruta que esta en el archivo .js


//Public
/**
 * Definimos la ruta en donde se encontraran los archivos estaticos
 * usualmente se le da el nombre de public, aqui se le coloca los archivos
 * css, js, librerias, frameworks etc
 */
app.use(express.static(path.join(__dirname, 'public')));

//Iniciamos el servidor
app.listen(app.get('port'), () => {
    console.log('Server on port', app.get('port'));
});