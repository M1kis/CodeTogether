<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sesión Pair Programming</title>

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

        .role-box {
            padding: 12px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .driver {
            background: #0369a1;
        }

        .navigator {
            background: #0284c7;
        }

        button {
            margin-top: 15px;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            color: white;
        }

        .switch-btn {
            background: #0ea5e9;
        }

        .end-btn {
            background: #ef4444;
        }

        .timer {
            font-size: 40px;
            font-weight: bold;
            margin-top: 10px;
            color: #38bdf8;
        }
    </style>
</head>
<body>

<div class="card">

    <h1>Pair Programming</h1>

    <h2>Sesión #{{ $session->id }}</h2>

    <p><b>Duración por turno:</b> {{ $session->turn_duration }} segundos</p>

    <div id="driverBox" class="role-box driver">
        <h3>Driver</h3>
        <p id="driverName">{{ $session->driver_name }}</p>
    </div>

    <div id="navigatorBox" class="role-box navigator">
        <h3>Navigator</h3>
        <p id="navigatorName">{{ $session->navigator_name }}</p>
    </div>

    <div class="timer" id="timer"></div>

    <form action="{{ route('pair.switch', $session->id) }}" method="POST">
        @csrf
        <button class="switch-btn">Cambiar rol manualmente</button>
    </form>

    <form action="{{ route('pair.end', $session->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="end-btn">Finalizar sesión</button>
    </form>

</div>


<script>
    let duration = {{ $session->turn_duration }};
    let sessionId = {{ $session->id }};
    let timerEl = document.getElementById("timer");

    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    function startTimer() {
        let timeLeft = duration;

        const interval = setInterval(() => {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;

            timerEl.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (timeLeft <= 0) {
                clearInterval(interval);
                autoSwitchRoles();
            }

            timeLeft--;
        }, 1000);
    }

    function autoSwitchRoles() {
        fetch(`/pair-session/${sessionId}/switch-ajax`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf
            }
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById("driverName").textContent = data.driver_name;
            document.getElementById("navigatorName").textContent = data.navigator_name;
            duration = data.turn_duration;
            startTimer();
        });
    }

    startTimer();
</script>

</body>
</html>
