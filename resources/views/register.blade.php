<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Registro</title>
    <style>
        .login-container_title {
            margin-top: 120px;
        }

        .login-container_form {
            padding-top: 10%;
        }
    </style>
</head>
<body>
    <main class="main">
        <section class="decoration">
            <picture class="logo">
                <a href="{{ url('/') }} ">
                    <img src="https://clotthy.com/logos/clotthy-light.png" alt="logo" class="logo_img"/>
                </a>
            </picture>
        </section>
        <section class="login">
            <div class="login-container">
                <h1 class="login-container_title">Registro</h1>
                <form action="#" method="POST" class="login-container_form" id="form">
                    <div class="control">
                        <input
                            type="text"
                            name="username"
                            placeholder="Nombre de usuario"
                            class="control_input"
                            id="username"
                        />
                    </div>
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
                            value="Registrar"
                            class="control_btn"
                            id="btn"
                        />
                    </div>
                    <div class="forgot-password">
                        <a href="{{ url('/login') }}" class="forgot-password_text">¿Ya tienes cuenta?</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script>
        localStorage.removeItem('size');
        localStorage.removeItem('color');
        localStorage.removeItem('order_by');
    </script>
    <script src="{{ mix('js/register.js') }}"></script>
</body>
</html>
