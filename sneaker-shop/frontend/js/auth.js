const API_BASE = "http://localhost/soleart/api";

async function registerUser(data) {
    const res = await fetch(`${API_BASE}/auth/register`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
        credentials: "include"
    });
    return res.json();
}

async function loginUser(username, password) {
    const res = await fetch(`${API_BASE}/auth/login`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password }),
        credentials: "include"
    });
    return res.json();
}

async function getCurrentUser() {
    const res = await fetch(`${API_BASE}/auth/me`, {
        method: "GET",
        credentials: "include"
    });
    return res.json();
}

async function logoutUser() {
    const res = await fetch(`${API_BASE}/auth/logout`, {
        method: "POST",
        credentials: "include"
    });
    return res.json();
}
