<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Temp API Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f6f6f6; margin: 0; padding: 40px; }
        .card { background: #fff; border-radius: 8px; padding: 24px; max-width: 420px; margin: 0 auto; box-shadow: 0 5px 25px rgba(0,0,0,0.08); }
        label { display: block; margin-bottom: 4px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #d1d1d1; border-radius: 6px; margin-bottom: 16px; }
        button { background: #1d4ed8; color: #fff; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer; }
        button:disabled { opacity: 0.5; cursor: not-allowed; }
        pre { background: #0f172a; color: #bef264; padding: 12px; border-radius: 6px; overflow: auto; }
        .link { margin-top: 12px; display: block; text-align: center; }
    </style>
</head>
<body>
<div class="card">
    <h1>Temp API Login</h1>
    <form id="login-form">
        <label for="login">Email or Username</label>
        <input type="text" id="login" placeholder="you@example.com" required>

        <label for="password">Password</label>
        <input type="password" id="password" placeholder="••••••••" required>

        <button type="submit">Login</button>
    </form>

    <h3>Token</h3>
    <pre id="token-output">—</pre>
    <small>Token is stored in browser localStorage under <code>temp_api_token</code>.</small>

    <h3>Response</h3>
    <pre id="login-result">—</pre>

    <a class="link" href="/temp/favorites">Go to Favorites Test Page →</a>
</div>

<script>
    const loginForm = document.getElementById('login-form');
    const loginResult = document.getElementById('login-result');
    const tokenOutput = document.getElementById('token-output');

    function setResult(text) {
        loginResult.textContent = typeof text === 'string' ? text : JSON.stringify(text, null, 2);
    }

    function setToken(token) {
        tokenOutput.textContent = token || '—';
        if (token) {
            localStorage.setItem('temp_api_token', token);
        }
    }

    // Prefill token if already saved
    setToken(localStorage.getItem('temp_api_token'));

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const login = document.getElementById('login').value;
        const password = document.getElementById('password').value;

        loginForm.querySelector('button').disabled = true;
        setResult('Logging in...');

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ login, password })
            });

            const data = await response.json();
            if (!response.ok) {
                throw data;
            }

            setResult(data);
            if (data.token) {
                setToken(data.token);
            } else {
                setToken('No token in response');
            }
        } catch (error) {
            setResult(error);
        } finally {
            loginForm.querySelector('button').disabled = false;
        }
    });
</script>
</body>
</html>
