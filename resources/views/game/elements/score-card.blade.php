<div class="score-card">
    <div class="heading medium">
        {{ $heading }}
    </div>
    <table>
    @foreach ($rows as $row)
        <tr>
            <td class="name">{{ $row['name'] }}</td>
            <td>{{ $row['score'] }}</td>
        </tr>
    @endforeach
    </table>
</div>