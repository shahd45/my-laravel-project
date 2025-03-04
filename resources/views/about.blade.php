<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!-- إضافة تنسيق CSS داخلي -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #4CAF50;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .department-info {
            margin-top: 20px;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Hello, {{ $name }}</h1> <!-- عرض اسم المستخدم -->

    <form action="{{ route('about') }}" method="POST">
        @csrf
        <input type="text" name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}">
        
        <br><br>

        <select name="department" id="department">
            <option value="">Select a Department</option>
            @foreach ($departments as $id => $department)
                <option value="{{ $id }}">{{ $department }}</option>
            @endforeach
        </select>
        
        <br><br>
        <input type="submit" value="Send">
    </form>

    <!-- إذا تم إرسال البيانات، عرض القسم المختار -->
    @if(isset($selectedDepartment))
        <div class="department-info">
            <h2>You selected: {{ $selectedDepartment }}</h2>
        </div>
    @endif
</body>
</html>
