<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT.SHI - Custom Material</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            perspective: 1000px;
        }

        .box-preview {
            width: 300px;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .cube {
            position: relative;
            width: 100px;
            height: 100px;
            transform-style: preserve-3d;
            transform: rotateX(-20deg) rotateY(30deg);
            transition: transform 0.2s;
        }

        .face {
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(0, 123, 255, 0.1);
            border: 1px solid #007bff;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .face.front {
            transform: translateZ(50px);
        }

        .face.back {
            transform: rotateY(180deg) translateZ(50px);
        }

        .face.right {
            transform: rotateY(90deg) translateZ(50px);
        }

        .face.left {
            transform: rotateY(-90deg) translateZ(50px);
        }

        .face.top {
            transform: rotateX(90deg) translateZ(50px);
        }

        .face.bottom {
            transform: rotateX(-90deg) translateZ(50px);
        }

        .dimensions {
            color: #007bff;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container mt-5">
        <h3 class="text-center">Interaktif Kubus Dimensi</h3>
        <div class="row">
            <!-- Kolom Kiri: Preview Kubus -->
            <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="box-preview">
                    <div class="cube" id="cube">
                        <div class="face front"></div>
                        <div class="face back"></div>
                        <div class="face right"></div>
                        <div class="face left"></div>
                        <div class="face top"></div>
                        <div class="face bottom"></div>
                    </div>
                </div>
                <div class="dimensions" id="box-dimensions">0 x 0 x 0 mm</div>
            </div>

            <!-- Kolom Kanan: Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title text-center">Perhitungan Harga Material Box</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customize.storeStep2') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="material_id" class="form-label">Bahan Material</label>
                                <select name="material_id" id="material_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Material</option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}">{{ $material->barang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="frame_id" class="form-label">Frame</label>
                                <select name="frame_id" id="frame_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Frame</option>
                                    @foreach ($frames as $frame)
                                        <option value="{{ $frame->id }}">{{ $frame->barang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label for="panjang" class="form-label">Panjang (mm)</label>
                                    <input type="number" name="panjang" id="panjang" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="lebar" class="form-label">Lebar (mm)</label>
                                    <input type="number" name="lebar" id="lebar" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="tinggi" class="form-label">Tinggi (mm)</label>
                                    <input type="number" name="tinggi" id="tinggi" class="form-control" required>
                                </div>
                            </div>
                            <div class="d-flex mt-4">
                                <a href="{{ url('/') }}" class="btn btn-warning me-2 px-4 py-2">Kembali</a>
                                <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let isDragging = false;
        let startX, startY;
        let currentX = -20, currentY = 30;

        const cube = document.getElementById('cube');

        cube.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.clientX;
            startY = e.clientY;
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;

            const deltaX = e.clientX - startX;
            const deltaY = e.clientY - startY;

            currentX += deltaY * 0.5;
            currentY += deltaX * 0.5;

            cube.style.transform = `rotateX(${currentX}deg) rotateY(${currentY}deg)`;

            startX = e.clientX;
            startY = e.clientY;
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });

        function updateCube() {
            const panjang = parseInt(document.getElementById('panjang').value) || 0;
            const lebar = parseInt(document.getElementById('lebar').value) || 0;
            const tinggi = parseInt(document.getElementById('tinggi').value) || 0;

            cube.style.width = `${lebar}px`;
            cube.style.height = `${tinggi}px`;

            const depth = panjang / 2;
            document.querySelector('.face.front').style.transform = `translateZ(${depth}px)`;
            document.querySelector('.face.back').style.transform = `rotateY(180deg) translateZ(${depth}px)`;
            document.querySelector('.face.right').style.transform = `rotateY(90deg) translateZ(${lebar / 2}px)`;
            document.querySelector('.face.left').style.transform = `rotateY(-90deg) translateZ(${lebar / 2}px)`;
            document.querySelector('.face.top').style.transform = `rotateX(90deg) translateZ(${tinggi / 2}px)`;
            document.querySelector('.face.bottom').style.transform = `rotateX(-90deg) translateZ(${tinggi / 2}px)`;

            document.getElementById('box-dimensions').textContent = `${panjang} x ${lebar} x ${tinggi} mm`;
        }

        document.getElementById('panjang').addEventListener('input', updateCube);
        document.getElementById('lebar').addEventListener('input', updateCube);
        document.getElementById('tinggi').addEventListener('input', updateCube);
    </script>
    @endsection
</body>
</html>
