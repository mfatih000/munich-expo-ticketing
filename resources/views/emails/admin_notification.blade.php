<h2>New Registration</h2>
<ul>
    <li><strong>Name:</strong> {{ $data['first_name'] }} {{ $data['last_name'] }}</li>
    <li><strong>Email:</strong> {{ $data['email'] }}</li>
    <li><strong>Company:</strong> {{ $data['company'] ?? '-' }}</li>
</ul>
