<div class="main">
    <div class="login-form">
        <h1>Member Login</h1>
        <div class="head">
            <img src="images/user.png" alt=""/>
        </div>
        <form>
            <input type="text" class="text" value="Usuario" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                            this.value = 'USERNAME';
                                                        }" >
            <input type="password" value="Contraseña" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                            this.value = 'Password';
                                                        }">
            <div class="submit">
                <input type="submit" onclick="Login()" value="INGRESAR" >
            </div>	
            <p><a href="#">Olvidastes tu contraseña ?</a></p>
        </form>
    </div>
</div>
<!-----//end-main---->