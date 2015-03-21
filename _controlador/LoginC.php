<div class="main">
    <div class="login-form">
        <h1>TESIS KESSLIN</h1>
        <div class="head">
            <img src="images/user.png" alt=""/>
        </div>
        <form id="Formlogin">
            <input type="text" class="text" id="usuario" value="Usuario" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                            this.value = 'USERNAME';
                                                        }" >
            <input type="password" id="contrasena" value="Contraseña" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                            this.value = 'Password';
                                                        }">
            <div class="submit">
                <input type="button" onclick="Login()" value="INGRESAR" >
            </div>	
            <p><a href="#">Olvidastes tu contraseña ?</a></p>
        </form>
    </div>
</div>
<!-----//end-main---->