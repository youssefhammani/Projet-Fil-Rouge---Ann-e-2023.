@php
    session()->forget('orders');
@endphp

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #333;
    }

    .button-container {
        display: flex;
        justify-content: space-around;
        width: 100%;
        margin-top: 20px;
    }

    .button {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
        border: none;
        outline: none;
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #45a049;
    }
</style>

<div class="container">
    <h1>Your request has been completed successfully</h1>
    <div class="button-container">
        <a href="{{ url('home') }}" class="button">go back home</a>
        <a href="{{ url('buying1') }}" class="button">Go track your order</a>
    </div>
</div>
