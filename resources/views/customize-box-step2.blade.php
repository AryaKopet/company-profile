<!-- resources/views/customize-box-step2.blade.php -->
<form action="{{ route('customize.box.step2.submit') }}" method="POST">
    @csrf
    
    <label for="material">Material:</label>
    <select name="material_id" id="material" required>
        @foreach($materials as $material)
            <option value="{{ $material->id }}">{{ $material->name }} - Rp{{ number_format($material->price, 0, ',', '.') }}</option>
        @endforeach
    </select>

    <label for="frame">Frame:</label>
    <select name="frame_id" id="frame" required>
        @foreach($frames as $frame)
            <option value="{{ $frame->id }}">{{ $frame->name }} - Rp{{ number_format($frame->price, 0, ',', '.') }}</option>
        @endforeach
    </select>

    <label for="length">Length (cm):</label>
    <input type="number" name="length" id="length" required>

    <label for="width">Width (cm):</label>
    <input type="number" name="width" id="width" required>

    <label for="height">Height (cm):</label>
    <input type="number" name="height" id="height" required>

    <button type="submit">Calculate</button>
</form>
