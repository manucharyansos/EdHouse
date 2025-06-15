<h2>Նոր հաղորդագրություն կայքից</h2>

<p><strong>Անուն:</strong> {{ $data['name'] }}</p>
<p><strong>Հեռախոս:</strong> {{ $data['phone'] ?? 'չկա' }}</p>
<p><strong>Էլ․ փոստ:</strong> {{ $data['email'] }}</p>
<p><strong>Հաղորդագրություն:</strong></p>
<p>{{ $data['message'] }}</p>
