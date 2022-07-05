<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    <main class="main">
        <section class="decoration">
            <picture class="logo">
                <img src="https://clotthy.com/logos/clotthy-light.png" alt="logo" class="logo_img"/>
            </picture>
        </section>
        <section class="login">
            <div class="login-container">
                <h1 class="login-container_title">Inicio de sesión</h1>
                <form action="#" method="POST" class="login-container_form" id="form">
                    <div class="control">
                        <input
                            type="email"
                            name="email"
                            placeholder="Correo electronico"
                            class="control_input"
                            id="email"
                        />
                    </div>
                    <div class="control">
                        <input
                            type="password"
                            name="password"
                            placeholder="Contraseña"
                            class="control_input"
                            id="password"
                        />
                    </div>
                    <div class="control">
                        <input
                            type="submit"
                            value="Iniciar sesión"
                            class="control_btn"
                            id="btn"
                        />
                    </div>
                    <div class="forgot-password">
                        <a href="#" class="forgot-password_text">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="{{ mix('js/login.js') }}"></script>
</body>
</html>
