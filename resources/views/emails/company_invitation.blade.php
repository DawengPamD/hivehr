<!DOCTYPE html>
<html>
<head>
    <title>Company Invitation</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var companyId = "{{ $invitation->companies }}"; 

            fetch(`/api/companies/${companyId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('companyName').innerText = data.name;
                    // You can handle other company data here
                })
                .catch(error => console.error('Error fetching company data:', error));
        });
    </script>
</head>
<body>
    @if($invitation)
    <h1 id="companyName">Loading company name...</h1>
        <p>Click the link below to join:</p>
        <a href="{{ route('company.acceptInvitation', $invitation->token) }}">Join Company</a>
    @else
        <h1>Invalid Invitation</h1>
        <p>The invitation link is invalid or the company information is missing.</p>
    @endif
</body>
</html>
