<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Favorites Test Console</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f1f5f9; margin: 0; padding: 40px; }
        .card { background: #fff; border-radius: 8px; padding: 24px; max-width: 640px; margin: 0 auto; box-shadow: 0 5px 25px rgba(0,0,0,0.08); }
        label { display: block; margin-bottom: 4px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #cbd5f5; border-radius: 6px; margin-bottom: 16px; }
        button { background: #0d9488; color: #fff; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer; margin-right: 8px; }
        button.secondary { background: #1d4ed8; }
        button.danger { background: #dc2626; }
        pre { background: #111827; color: #d1fae5; padding: 12px; border-radius: 6px; overflow: auto; }
    </style>
</head>
<body>
<div class="card">
    <h1>Favorites Test Console</h1>
    <p>Use the login page first to grab a Sanctum API token, or paste a token below.</p>

    <label for="token">Bearer Token</label>
    <input type="text" id="token" placeholder="Paste token or click 'Load saved token'">
    <button id="load-token" type="button">Load saved token</button>

    <label for="hadith-id">Hadith ID</label>
    <input type="number" id="hadith-id" min="1" placeholder="Numeric hadith ID">

    <div>
        <button class="secondary" id="list-favorites" type="button">List Favorites</button>
        <button id="add-favorite" type="button">Add Favorite</button>
        <button class="danger" id="remove-favorite" type="button">Remove Favorite</button>
    </div>

    <h3>Response</h3>
    <pre id="result">—</pre>

    <a href="/temp/login">← Back to login</a>
</div>

<script>
    const result = document.getElementById('result');
    const tokenInput = document.getElementById('token');
    const hadithInput = document.getElementById('hadith-id');

    const savedToken = localStorage.getItem('temp_api_token');
    if (savedToken) {
        tokenInput.value = savedToken;
    }

    document.getElementById('load-token').addEventListener('click', () => {
        tokenInput.value = localStorage.getItem('temp_api_token') || '';
    });

    function setResult(payload) {
        result.textContent = typeof payload === 'string' ? payload : JSON.stringify(payload, null, 2);
    }

    async function callApi(endpoint, options = {}) {
        const token = tokenInput.value.trim();
        if (!token) {
            setResult('Missing token. Login first.');
            throw new Error('No token');
        }

        const fetchOptions = {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            ...options
        };

        if (options.body && typeof options.body === 'object') {
            fetchOptions.body = JSON.stringify(options.body);
            fetchOptions.headers['Content-Type'] = 'application/json';
        }

        const response = await fetch(endpoint, fetchOptions);
        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        return data;
    }

    document.getElementById('list-favorites').addEventListener('click', async () => {
        setResult('Loading favorites...');
        try {
            const data = await callApi('/api/favorites');
            setResult(data);
        } catch (error) {
            setResult(error);
        }
    });

    document.getElementById('add-favorite').addEventListener('click', async () => {
        const hadith_id = Number(hadithInput.value);
        if (!hadith_id) {
            setResult('Enter a hadith ID to add');
            return;
        }

        setResult('Adding favorite...');
        try {
            const data = await callApi('/api/favorites/add', {
                method: 'POST',
                body: { hadith_id }
            });
            setResult(data);
        } catch (error) {
            setResult(error);
        }
    });

    document.getElementById('remove-favorite').addEventListener('click', async () => {
        const hadith_id = Number(hadithInput.value);
        if (!hadith_id) {
            setResult('Enter a hadith ID to remove');
            return;
        }

        setResult('Removing favorite...');
        try {
            const data = await callApi('/api/favorites/remove', {
                method: 'POST',
                body: { hadith_id }
            });
            setResult(data);
        } catch (error) {
            setResult(error);
        }
    });
</script>
</body>
</html>
