<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">API Documentation</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Get Dashboard Data</h2>
            <p class="mb-2"><span class="font-semibold">Endpoint:</span> /api/v1/dashboard/get_data</p>
            <p class="mb-2"><span class="font-semibold">Method:</span> GET</p>
            <p class="mb-4"><span class="font-semibold">Description:</span> Retrieves the main dashboard data for disasters.</p>
            <h3 class="text-xl font-semibold mb-2">Response</h3>
            <pre class="bg-gray-100 p-4 rounded-md overflow-x-auto">
{
    "success": true,
    "kode": 200,
    "message": "Data Utama Dashboard Bencana",
    "data": {
        // Dashboard data structure
    }
}
            </pre>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Get Raw Disaster Impact Data</h2>
            <p class="mb-2"><span class="font-semibold">Endpoint:</span> /api/v1/dashboard/getRawData/{token}</p>
            <p class="mb-2"><span class="font-semibold">Method:</span> GET</p>
            <p class="mb-4"><span class="font-semibold">Description:</span> Retrieves raw data about the impact of a specific disaster.</p>
            <h3 class="text-xl font-semibold mb-2">Parameters</h3>
            <p class="mb-2"><span class="font-semibold">token:</span> Unique identifier for the disaster</p>
            <h3 class="text-xl font-semibold mb-2">Response</h3>
            <pre class="bg-gray-100 p-4 rounded-md overflow-x-auto">
{
    "success": true,
    "kode": 200,
    "message": "Data Mentah Dampak Bencana",
    "data": {
        // Raw disaster impact data
    }
}
            </pre>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Get Disaster Impact Data</h2>
            <p class="mb-2"><span class="font-semibold">Endpoint:</span> /api/v1/dashboard/get_dampak_bencana/{token}</p>
            <p class="mb-2"><span class="font-semibold">Method:</span> GET</p>
            <p class="mb-4"><span class="font-semibold">Description:</span> Retrieves formatted data about the impact of a specific disaster.</p>
            <h3 class="text-xl font-semibold mb-2">Parameters</h3>
            <p class="mb-2"><span class="font-semibold">token:</span> Unique identifier for the disaster</p>
            <h3 class="text-xl font-semibold mb-2">Response</h3>
            <pre class="bg-gray-100 p-4 rounded-md overflow-x-auto">
{
    "success": true,
    "kode": 200,
    "message": "Data Dampak Bencana",
    "data": {
        // Formatted disaster impact data
    }
}
            </pre>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">Get Detailed Disaster Information</h2>
            <p class="mb-2"><span class="font-semibold">Endpoint:</span> /api/v1/dashboard/get_detail_bencana/{token}</p>
            <p class="mb-2"><span class="font-semibold">Method:</span> GET</p>
            <p class="mb-4"><span class="font-semibold">Description:</span> Retrieves detailed information about a specific disaster.</p>
            <h3 class="text-xl font-semibold mb-2">Parameters</h3>
            <p class="mb-2"><span class="font-semibold">token:</span> Unique identifier for the disaster</p>
            <h3 class="text-xl font-semibold mb-2">Response</h3>
            <pre class="bg-gray-100 p-4 rounded-md overflow-x-auto">
{
    "success": true,
    "kode": 200,
    "message": "Data Detail Bencana",
    "data": {
        "bencana": {
            // General disaster information
        },
        "dataDetail": [
            // Detailed disaster data
        ]
    }
}
            </pre>
        </div>
    </div>
</body>
</html>
