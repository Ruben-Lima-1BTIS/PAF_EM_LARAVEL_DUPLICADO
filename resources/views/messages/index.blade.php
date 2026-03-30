@extends('layouts.auth')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

.messages-page * {
    font-family: 'Sora', sans-serif;
}

.messages-page {
    background: #f5f8fa;
    min-height: 100vh;
}

/* PAGE HEADER */
.page-header {
    position: relative;
    padding-bottom: 1.5rem;
    margin-bottom: 1rem;
}
.page-header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 48px; height: 3px;
    background: #60a5fa;
    border-radius: 9999px;
}
.page-header h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: black;
    margin-bottom: 0.35rem;
}
.page-header p {
    font-size: 0.875rem;
    color: #475569;
}

/* GRID LAYOUT */
.grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem;
}
@media(min-width:1024px) {
    .grid { grid-template-columns: repeat(3, 1fr); }
}

/* CARD STYLES */
.card {
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #dbeafe;
    box-shadow: 0 1px 3px rgba(59,130,246,0.1);
    transition: 0.2s ease;
}
.card:hover {
    box-shadow: 0 6px 16px rgba(59,130,246,0.15);
}
.card-body { padding: 1.75rem; }

/* PLACEHOLDER STATS */
.stat-card {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.stat-icon-wrap {
    width: 52px; height: 52px;
    border-radius: 0.875rem;
    background: #dbeafe;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem;
    color: #3b82f6;
}
.stat-label {
    font-size: 0.75rem;
    color: #475569;
    margin-bottom: 0.15rem;
}
.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #000000;
}

/* TABLE STYLES */
.messages-table {
    width: 100%;
    border-collapse: collapse;
}
.messages-table thead th {
    padding: 0.6rem 0.75rem;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #424242;
    text-align: left;
}
.messages-table tbody tr {
    border-top: 1px solid #dbeafe;
    transition: 0.15s ease;
}
.messages-table tbody tr:hover {
    background: #eff6ff;
}
.messages-table td {
    padding: 0.9rem 0.75rem;
    font-size: 0.85rem;
    color: #000000;
}

/* PLACEHOLDER BADGES */
.badge-placeholder {
    background: #e0e7ff;
    color: #6366f1;
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    font-size: 0.72rem;
    font-weight: 600;
}

/* CHAT BUBBLES */
.chat-container {
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.chat-bubble {
    max-width: 60%;
    padding: 0.75rem 1rem;
    border-radius: 1rem;
    position: relative;
    font-size: 0.875rem;
    line-height: 1.25rem;
}
.chat-bubble.user {
    background: #3b82f6;
    color: #fff;
    align-self: flex-end;
    border-bottom-right-radius: 0.25rem;
}
.chat-bubble.admin {
    background: #e0e7ff;
    color: #1e293b;
    align-self: flex-start;
    border-bottom-left-radius: 0.25rem;
}
.chat-bubble::after {
    content: '';
    position: absolute;
    width: 0; height: 0;
}
.chat-bubble.user::after {
    border-left: 8px solid #3b82f6;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
    right: -8px;
    top: 12px;
}
.chat-bubble.admin::after {
    border-right: 8px solid #e0e7ff;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
    left: -8px;
    top: 12px;
}

/* ANIMATION */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}
.fade-up { animation: fadeUp 0.4s ease both; }
</style>

<div class="messages-page">
<div class="max-w-6xl mx-auto p-6 space-y-8">

    {{-- PAGE HEADER --}}
    <div class="page-header fade-up">
        <h2>Messages</h2>
        <p>Manage your internship communications</p>
    </div>

    <div class="grid gap-6">

        {{-- STATS PLACEHOLDER --}}
        <div class="lg:col-span-1 card fade-up">
            <div class="card-body">
                <div class="stat-card">
                    <div class="stat-icon-wrap">📬</div>
                    <div>
                        <p class="stat-label">Total Messages</p>
                        <p class="stat-value">—</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLE PLACEHOLDER --}}
        <div class="lg:col-span-2 card fade-up">
            <div class="card-body">
                <p class="section-label">Inbox</p>
                <h3 class="card-title" style="margin-bottom:1.25rem;">Coming Soon</h3>

                <div class="overflow-x-auto">
                    <table class="messages-table">
                        <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0; $i<5; $i++)
                            <tr>
                                <td>—</td>
                                <td>Feature in progress</td>
                                <td><span class="badge-placeholder">Pending</span></td>
                                <td>—</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                {{-- FAKE CHAT BUBBLES --}}
                <div class="chat-container mt-6">
                    <div class="chat-bubble admin">Hi! 👋 This messaging feature will be available soon.</div>
                    <div class="chat-bubble user">Can’t wait to use it!</div>
                    <div class="chat-bubble admin">We’re working hard to get it ready for you.</div>
                    <div class="chat-bubble user">Alright, I’ll be patient 😏</div>
                    <div class="chat-bubble admin">Thanks for understanding! 🚀</div>
                </div>

            </div>
        </div>

    </div>

</div>
</div>

@endsection