const bcrypt = require("bcryptjs");
const helpers = {};

// creamos un metodo el cual le pasaremos la contrasena
//
helpers.encrypPassword = async (password) => {
    //generar un patron para cifrar
    const salt = await bcrypt.genSalt(10);
    //cifrando la contrasena 
    const hash = await bcrypt.hash(password, salt);
    return hash;
};
//metodo para comprar contrasena cifradas
helpers.matchPassword = async (password, savePassword) => {
    try{
        //retorna el resultado de esa consulta
        return await bcrypt.compare(password, savePassword);
    }catch(e){
        console.log(e);
    }
}
module.exports = helpers;
