<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('css/password.css') }}">
    <title>Recuperar contraseña</title>
</head>
<body>
    <main class="main">
        <section class="section">
            <div class="container-primary">
                <img
                    src="{{ asset('images/imgpassword.svg') }}"
                    alt="Imagen"
                    class="imgsvg"
                />
                <h1 class="title">Restablecer contraseña</h1>
                <form action="{{ route('reset',[
                        'userType'=>$userType,
                        'id'=>$id,
                        'tokenId'=>$tokenId,
                        'token'=>$token]) }}"
                        method="POST"
                        class="form"
                    >
                    @csrf
                    <div class="container">
                        <div class="control">
                            <input
                                type="password"
                                name="password"
                                placeholder="Contraseña"
                                class="control_input"
                                id="password"
                                required
                            />
                        </div>
                        <div class="control">
                            <input
                                type="password"
                                name="passwordconfirm"
                                placeholder="Confirmar contraseña"
                                class="control_input"
                                id="passwordconfirm"
                                required
                            />
                        </div>
                        @error('message')
                            <p class="msg" style=@error('color') {{ "color:$message" }} @enderror>
                                @if(str_contains($message, "\n"))
                                    {!! nl2br($message) !!}
                                @else 
                                    {{ $message }}
                                @endif
                            </p>
                        @enderror
                        <div class="control">
                            <input
                                type="submit"
                                value="Guardar"
                                class="control_btn"
                                id="btn"
                            />
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
