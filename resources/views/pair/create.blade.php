<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Sesión | Pair Programming</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #1e293b;
            padding: 30px;
            border-radius: 15px;
            width: 420px;
            text-align: center;
        }

        h1, h2, p {
            margin: 8px 0;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            margin-top: 6px;
            background-color: #0f172a;
            color: white;
        }

        label {
            font-weight: bold;
            display: block;
            text-align: left;
            margin-top: 12px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            color: white;
            background: #0ea5e9;
        }

        button:hover {
            background: #0284c7;
        }

        .error {
            color: #ef4444;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>Crear Sesión</h1>
        <p>Configura los datos para iniciar una sesión de Pair Programming.</p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    • {{ $error }} <br>
                @endforeach
            </div>
        @endif

        <form action="{{ route('pair.store') }}" method="POST">
            @csrf

            <label>Nombre del Driver (quien escribe código):</label>
            <input type="text" name="driver_name" placeholder="Ej: Cristian" required>

            <label>Nombre del Navigator (quien guía):</label>
            <input type="text" name="navigator_name" placeholder="Ej: Pablo" required>

            <label>Duración por turno (segundos):</label>
            <input type="number" name="turn_duration" min="1" placeholder="Ej: 5" required>

            {{-- Código eliminado porque ahora se genera automático --}}

            <button type="submit">Crear sesión</button>
        </form>
    </div>

</body>
</html>
