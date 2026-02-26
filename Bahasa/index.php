<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Santri App</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #2d3748;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .header h1 {
            color: #4a5568;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header p {
            color: #718096;
            font-size: 1.1rem;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            background: white;
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .tab-btn {
            padding: 15px 30px;
            background: transparent;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-family: inherit;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 5px;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .tab-content {
            display: none;
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .tab-content.active {
            display: block;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: inherit;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            padding: 15px 25px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }

        .btn-info {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
        }

        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .student-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 5px solid #48bb78;
        }

        .student-card.danger {
            border-left-color: #f56565;
            background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
        }

        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .student-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .student-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .student-class {
            background: #e2e8f0;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .student-points {
            font-size: 1.5rem;
            font-weight: 700;
            color: #48bb78;
        }

        .student-points.danger {
            color: #f56565;
        }

        .competition-form {
            background: #f7fafc;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .participant-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
            gap: 15px;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .score-input {
            width: 80px;
            padding: 8px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            text-align: center;
        }

        .total-score {
            font-weight: 700;
            font-size: 1.1rem;
            color: #667eea;
        }

        .competition-results {
            margin-top: 30px;
        }

        .result-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .result-info h4 {
            color: #2d3748;
            margin-bottom: 5px;
        }

        .result-details {
            font-size: 0.9rem;
            color: #718096;
        }

        .result-score {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            color: #718096;
        }

        .close:hover {
            color: #2d3748;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #718096;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .participant-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .tabs {
                flex-direction: column;
            }
            
            .tab-btn {
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Monitoring Santri</h1>
            <p>Sistem Pencatatan Pelanggaran Bahasa & Penilaian Khitobah/Speech</p>
        </div>

        <div class="tabs">
            <button class="tab-btn active" onclick="showTab('violations')">📋 Pelanggaran Bahasa</button>
            <button class="tab-btn" onclick="showTab('competition')">🎤 Khitobah & Speech</button>
            <button class="tab-btn" onclick="showTab('reports')">📊 Laporan</button>
        </div>

        <!-- Tab Pelanggaran Bahasa -->
        <div id="violations" class="tab-content active">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" id="totalStudents">0</div>
                    <div class="stat-label">Total Santri</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="violationsToday">0</div>
                    <div class="stat-label">Pelanggaran Hari Ini</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="lowScoreStudents">0</div>
                    <div class="stat-label">Santri Nilai Rendah</div>
                </div>
            </div>

            <div class="form-group">
                <label>Pilih Santri</label>
                <select id="studentSelect" class="form-control">
                    <option value="">-- Pilih Santri --</option>
                </select>
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 30px;">
                <button class="btn btn-danger" onclick="addViolation()">➖ Tambah Pelanggaran (-2)</button>
                <button class="btn btn-success" onclick="addReward()">➕ Tambah Poin (+2)</button>
                <button class="btn btn-primary" onclick="showAddStudentModal()">👤 Tambah Santri</button>
                <button class="btn btn-info" onclick="exportViolationsData()">📥 Export Data</button>
            </div>

            <div class="student-grid" id="studentGrid">
                <!-- Student cards will be populated here -->
            </div>
        </div>

        <!-- Tab Kompetisi -->
        <div id="competition" class="tab-content">
            <div class="competition-form">
                <h3 style="margin-bottom: 20px; color: #4a5568;">📝 Input Kompetisi Baru</h3>
                
                <div class="form-group">
                    <label>Kategori Kompetisi</label>
                    <select id="competitionType" class="form-control">
                        <option value="khitobah">🎤 Khitobah</option>
                        <option value="speech">🗣️ Speech</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Kelompok</label>
                    <input type="text" id="groupName" class="form-control" placeholder="Masukkan nama kelompok">
                </div>

                <h4 style="margin: 20px 0; color: #4a5568;">👥 Peserta (8 Orang)</h4>
                
                <div id="participantsContainer">
                    <!-- Participant rows will be generated here -->
                </div>

                <button class="btn btn-primary" onclick="saveCompetition()">💾 Simpan Kompetisi</button>
            </div>

            <div class="competition-results" id="competitionResults">
                <h3 style="margin-bottom: 20px; color: #4a5568;">🏆 Hasil Kompetisi</h3>
                <!-- Competition results will be displayed here -->
            </div>
        </div>

        <!-- Tab Laporan -->
        <div id="reports" class="tab-content">
            <h3 style="margin-bottom: 30px; color: #4a5568;">📊 Laporan & Export Data</h3>
            
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px;">
                <button class="btn btn-info" onclick="exportViolationsData()">📥 Export Data Pelanggaran</button>
                <button class="btn btn-info" onclick="exportCompetitionData()">📥 Export Data Kompetisi</button>
                <button class="btn btn-primary" onclick="generateReport()">📋 Generate Laporan</button>
            </div>

            <div id="reportContent">
                <!-- Report content will be displayed here -->
            </div>
        </div>
    </div>

    <!-- Modal Add Student -->
    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addStudentModal')">&times;</span>
            <h3 style="margin-bottom: 20px; color: #4a5568;">👤 Tambah Santri Baru</h3>
            
            <div class="form-group">
                <label>Nama Santri</label>
                <input type="text" id="newStudentName" class="form-control" placeholder="Masukkan nama santri">
            </div>
            
            <div class="form-group">
                <label>Kelas</label>
                <input type="text" id="newStudentClass" class="form-control" placeholder="Masukkan kelas">
            </div>
            
            <button class="btn btn-primary" onclick="addNewStudent()">➕ Tambah Santri</button>
        </div>
    </div>

    <script>
        // Database simulation using localStorage
        let studentsData = JSON.parse(localStorage.getItem('studentsData')) || [];
        let competitionsData = JSON.parse(localStorage.getItem('competitionsData')) || [];
        let violationsHistory = JSON.parse(localStorage.getItem('violationsHistory')) || [];

        // Initialize sample data if empty
        if (studentsData.length === 0) {
            studentsData = [
                { id: 1, name: 'Ahmad Fauzi', class: 'VII-A', points: 100 },
                { id: 2, name: 'Fatimah Zahra', class: 'VII-A', points: 85 },
                { id: 3, name: 'Muhammad Rizki', class: 'VII-B', points: 95 },
                { id: 4, name: 'Aisyah Putri', class: 'VII-B', points: 78 },
                { id: 5, name: 'Abdullah Hassan', class: 'VIII-A', points: 88 },
                { id: 6, name: 'Khadijah Sari', class: 'VIII-A', points: 92 },
                { id: 7, name: 'Umar Faruq', class: 'VIII-B', points: 70 },
                { id: 8, name: 'Mariam Salma', class: 'VIII-B', points: 96 }
            ];
            saveData();
        }

        function saveData() {
            localStorage.setItem('studentsData', JSON.stringify(studentsData));
            localStorage.setItem('competitionsData', JSON.stringify(competitionsData));
            localStorage.setItem('violationsHistory', JSON.stringify(violationsHistory));
        }

        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab and activate button
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
            
            // Load data based on tab
            if (tabName === 'violations') {
                loadStudentData();
            } else if (tabName === 'competition') {
                loadCompetitionTab();
            } else if (tabName === 'reports') {
                generateReport();
            }
        }

        function loadStudentData() {
            // Update statistics
            document.getElementById('totalStudents').textContent = studentsData.length;
            
            const today = new Date().toDateString();
            const todayViolations = violationsHistory.filter(v => 
                new Date(v.date).toDateString() === today && v.type === 'violation'
            ).length;
            document.getElementById('violationsToday').textContent = todayViolations;
            
            const lowScoreCount = studentsData.filter(s => s.points < 75).length;
            document.getElementById('lowScoreStudents').textContent = lowScoreCount;

            // Populate student dropdown
            const select = document.getElementById('studentSelect');
            select.innerHTML = '<option value="">-- Pilih Santri --</option>';
            studentsData.forEach(student => {
                const option = document.createElement('option');
                option.value = student.id;
                option.textContent = `${student.name} (${student.class})`;
                select.appendChild(option);
            });

            // Display student cards
            displayStudentCards();
        }

        function displayStudentCards() {
            const grid = document.getElementById('studentGrid');
            grid.innerHTML = '';

            studentsData.forEach(student => {
                const card = document.createElement('div');
                card.className = `student-card ${student.points < 75 ? 'danger' : ''}`;
                
                card.innerHTML = `
                    <div class="student-name">${student.name}</div>
                    <div class="student-info">
                        <span class="student-class">${student.class}</span>
                        <span class="student-points ${student.points < 75 ? 'danger' : ''}">${student.points}</span>
                    </div>
                    <div style="font-size: 0.9rem; color: #718096;">
                        ${student.points < 75 ? '⚠️ Perlu Perhatian' : '✅ Baik'}
                    </div>
                `;
                
                grid.appendChild(card);
            });
        }

        function addViolation() {
            const studentId = document.getElementById('studentSelect').value;
            if (!studentId) {
                alert('Pilih santri terlebih dahulu!');
                return;
            }

            const student = studentsData.find(s => s.id == studentId);
            if (student) {
                student.points = Math.max(0, student.points - 2);
                
                violationsHistory.push({
                    studentId: studentId,
                    studentName: student.name,
                    type: 'violation',
                    points: -2,
                    date: new Date().toISOString(),
                    description: 'Pelanggaran bahasa'
                });
                
                saveData();
                loadStudentData();
                alert(`Pelanggaran dicatat untuk ${student.name}. Poin: ${student.points}`);
            }
        }

        function addReward() {
            const studentId = document.getElementById('studentSelect').value;
            if (!studentId) {
                alert('Pilih santri terlebih dahulu!');
                return;
            }

            const student = studentsData.find(s => s.id == studentId);
            if (student) {
                student.points = Math.min(100, student.points + 2);
                
                violationsHistory.push({
                    studentId: studentId,
                    studentName: student.name,
                    type: 'reward',
                    points: +2,
                    date: new Date().toISOString(),
                    description: 'Reward dari ustadz'
                });
                
                saveData();
                loadStudentData();
                alert(`Poin reward ditambahkan untuk ${student.name}. Poin: ${student.points}`);
            }
        }

        function showAddStudentModal() {
            document.getElementById('addStudentModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function addNewStudent() {
            const name = document.getElementById('newStudentName').value.trim();
            const className = document.getElementById('newStudentClass').value.trim();
            
            if (!name || !className) {
                alert('Nama dan kelas harus diisi!');
                return;
            }

            const newId = Math.max(...studentsData.map(s => s.id), 0) + 1;
            studentsData.push({
                id: newId,
                name: name,
                class: className,
                points: 100
            });

            saveData();
            loadStudentData();
            closeModal('addStudentModal');
            
            // Clear form
            document.getElementById('newStudentName').value = '';
            document.getElementById('newStudentClass').value = '';
            
            alert(`Santri ${name} berhasil ditambahkan!`);
        }

        function loadCompetitionTab() {
            generateParticipantRows();
            displayCompetitionResults();
        }

        function generateParticipantRows() {
            const container = document.getElementById('participantsContainer');
            container.innerHTML = '';

            for (let i = 1; i <= 8; i++) {
                const row = document.createElement('div');
                row.className = 'participant-row';
                row.innerHTML = `
                    <select class="form-control participant-select" data-index="${i}">
                        <option value="">-- Pilih Santri ${i} --</option>
                        ${studentsData.map(s => `<option value="${s.id}">${s.name} (${s.class})</option>`).join('')}
                    </select>
                    <input type="number" class="score-input" placeholder="1-45" min="1" max="45" data-type="fluency" data-index="${i}">
                    <input type="number" class="score-input" placeholder="1-25" min="1" max="25" data-type="gesture" data-index="${i}">
                    <input type="number" class="score-input" placeholder="1-30" min="1" max="30" data-type="material" data-index="${i}">
                    <div class="total-score" id="total-${i}">0</div>
                    <button class="btn btn-danger" style="padding: 8px 12px;" onclick="clearParticipant(${i})">❌</button>
                `;
                container.appendChild(row);
            }

            // Add event listeners for score calculation
            container.addEventListener('input', calculateTotalScores);
        }

        function calculateTotalScores() {
            for (let i = 1; i <= 8; i++) {
                const fluency = parseInt(document.querySelector(`input[data-type="fluency"][data-index="${i}"]`).value) || 0;
                const gesture = parseInt(document.querySelector(`input[data-type="gesture"][data-index="${i}"]`).value) || 0;
                const material = parseInt(document.querySelector(`input[data-type="material"][data-index="${i}"]`).value) || 0;
                
                const total = fluency + gesture + material;
                document.getElementById(`total-${i}`).textContent = total;
            }
        }

        function clearParticipant(index) {
            document.querySelector(`select[data-index="${index}"]`).value = '';
            document.querySelector(`input[data-type="fluency"][data-index="${index}"]`).value = '';
            document.querySelector(`input[data-type="gesture"][data-index="${index}"]`).value = '';
            document.querySelector(`input[data-type="material"][data-index="${index}"]`).value = '';
            document.getElementById(`total-${index}`).textContent = '0';
        }

        function saveCompetition() {
            const competitionType = document.getElementById('competitionType').value;
            const groupName = document.getElementById('groupName').value.trim();
            
            if (!groupName) {
                alert('Nama kelompok harus diisi!');
                return;
            }

            const participants = [];
            let hasParticipants = false;

            for (let i = 1; i <= 8; i++) {
                const studentId = document.querySelector(`select[data-index="${i}"]`).value;
                const fluency = parseInt(document.querySelector(`input[data-type="fluency"][data-index="${i}"]`).value) || 0;
                const gesture = parseInt(document.querySelector(`input[data-type="gesture"][data-index="${i}"]`).value) || 0;
                const material = parseInt(document.querySelector(`input[data-type="material"][data-index="${i}"]`).value) || 0;

                if (studentId && (fluency > 0 || gesture > 0 || material > 0)) {
                    const student = studentsData.find(s => s.id == studentId);
                    participants.push({
                        studentId: studentId,
                        studentName: student.name,
                        studentClass: student.class,
                        fluency: fluency,
                        gesture: gesture,
                        material: material,
                        total: fluency + gesture + material
                    });
                    hasParticipants = true;
                }
            }

            if (!hasParticipants) {
                alert('Minimal harus ada satu peserta dengan nilai!');
                return;
            }

            const competition = {
                id: Date.now(),
                type: competitionType,
                groupName: groupName,
                participants: participants,
                date: new Date().toISOString(),
                createdAt: new Date().toLocaleString('id-ID')
            };

            competitionsData.push(competition);
            saveData();
            
            // Clear form
            document.getElementById('groupName').value = '';
            generateParticipantRows();
            displayCompetitionResults();
            
            alert(`Kompetisi ${competitionType} untuk kelompok "${groupName}" berhasil disimpan!`);
        }

        function displayCompetitionResults() {
            const container = document.getElementById('competitionResults');
            
            if (competitionsData.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #718096;">Belum ada data kompetisi</p>';
                return;
            }

            container.innerHTML = '<h3 style="margin-bottom: 20px; color: #4a5568;">🏆 Hasil Kompetisi</h3>';

            competitionsData.reverse().forEach(competition => {
                const resultDiv = document.createElement('div');
                resultDiv.className = 'result-card';
                
                const topParticipant = competition.participants.sort((a, b) => b.total - a.total)[0];
                
                resultDiv.innerHTML = `
                    <div class="result-info">
                        <h4>${competition.type.toUpperCase()} - ${competition.groupName}</h4>
                        <div class="result-details">
                            ${competition.createdAt} • ${competition.participants.length} peserta
                            <br>Tertinggi: ${topParticipant.studentName} (${topParticipant.total} poin)
                        </div>
                    </div>
                    <div class="result-score">${topParticipant.total}</div>
                `;
                
                container.appendChild(resultDiv);
            });
        }

        function exportViolationsData() {
            const workbook = XLSX.utils.book_new();
            
            // Students data
            const studentsSheet = XLSX.utils.json_to_sheet(
                studentsData.map(s => ({
                    'Nama': s.name,
                    'Kelas': s.class,
                    'Poin': s.points,
                    'Status': s.points < 75 ? 'Perlu Perhatian' : 'Baik'
                }))
            );
            XLSX.utils.book_append_sheet(workbook, studentsSheet, 'Data Santri');
            
            // Violations history
            if (violationsHistory.length > 0) {
                const violationsSheet = XLSX.utils.json_to_sheet(
                    violationsHistory.map(v => ({
                        'Tanggal': new Date(v.date).toLocaleDateString('id-ID'),
                        'Nama Santri': v.studentName,
                        'Jenis': v.type === 'violation' ? 'Pelanggaran' : 'Reward',
                        'Poin': v.points,
                        'Keterangan': v.description
                    }))
                );
                XLSX.utils.book_append_sheet(workbook, violationsSheet, 'Riwayat Pelanggaran');
            }
            
            // Export file
            const fileName = `Data_Pelanggaran_${new Date().toISOString().split('T')[0]}.xlsx`;
            XLSX.writeFile(workbook, fileName);
        }

        function exportCompetitionData() {
            if (competitionsData.length === 0) {
                alert('Belum ada data kompetisi untuk diekspor!');
                return;
            }

            const workbook = XLSX.utils.book_new();
            
            // Competition summary
            const competitionSummary = competitionsData.map(comp => ({
                'Tanggal': new Date(comp.date).toLocaleDateString('id-ID'),
                'Jenis': comp.type.toUpperCase(),
                'Nama Kelompok': comp.groupName,
                'Jumlah Peserta': comp.participants.length,
                'Nilai Tertinggi': Math.max(...comp.participants.map(p => p.total))
            }));
            
            const summarySheet = XLSX.utils.json_to_sheet(competitionSummary);
            XLSX.utils.book_append_sheet(workbook, summarySheet, 'Ringkasan Kompetisi');
            
            // Detailed results
            const detailedResults = [];
            competitionsData.forEach(comp => {
                comp.participants.forEach(participant => {
                    detailedResults.push({
                        'Tanggal': new Date(comp.date).toLocaleDateString('id-ID'),
                        'Jenis Kompetisi': comp.type.toUpperCase(),
                        'Kelompok': comp.groupName,
                        'Nama Santri': participant.studentName,
                        'Kelas': participant.studentClass,
                        'Kelancaran': participant.fluency,
                        'Gestur': participant.gesture,
                        'Materi': participant.material,
                        'Total': participant.total
                    });
                });
            });
            
            const detailsSheet = XLSX.utils.json_to_sheet(detailedResults);
            XLSX.utils.book_append_sheet(workbook, detailsSheet, 'Detail Penilaian');
            
            // Export file
            const fileName = `Data_Kompetisi_${new Date().toISOString().split('T')[0]}.xlsx`;
            XLSX.writeFile(workbook, fileName);
        }

        function generateReport() {
            const reportContent = document.getElementById('reportContent');
            
            // Calculate statistics
            const totalStudents = studentsData.length;
            const lowScoreStudents = studentsData.filter(s => s.points < 75).length;
            const averagePoints = studentsData.reduce((sum, s) => sum + s.points, 0) / totalStudents;
            const totalCompetitions = competitionsData.length;
            const totalViolations = violationsHistory.filter(v => v.type === 'violation').length;
            const totalRewards = violationsHistory.filter(v => v.type === 'reward').length;
            
            // Get recent violations (last 7 days)
            const weekAgo = new Date();
            weekAgo.setDate(weekAgo.getDate() - 7);
            const recentViolations = violationsHistory.filter(v => 
                new Date(v.date) > weekAgo && v.type === 'violation'
            ).length;
            
            reportContent.innerHTML = `
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">${totalStudents}</div>
                        <div class="stat-label">Total Santri</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">${averagePoints.toFixed(1)}</div>
                        <div class="stat-label">Rata-rata Poin</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">${lowScoreStudents}</div>
                        <div class="stat-label">Santri Poin < 75</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">${totalCompetitions}</div>
                        <div class="stat-label">Total Kompetisi</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">${totalViolations}</div>
                        <div class="stat-label">Total Pelanggaran</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">${recentViolations}</div>
                        <div class="stat-label">Pelanggaran 7 Hari</div>
                    </div>
                </div>
                
                <div style="margin-top: 30px;">
                    <h4 style="color: #4a5568; margin-bottom: 20px;">📊 Analisis Data</h4>
                    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                        <p><strong>Status Keseluruhan:</strong> ${lowScoreStudents === 0 ? 'Semua santri dalam kondisi baik' : `${lowScoreStudents} santri memerlukan perhatian khusus`}</p>
                        <p><strong>Trend Pelanggaran:</strong> ${recentViolations > totalViolations/2 ? 'Meningkat dalam 7 hari terakhir' : 'Stabil'}</p>
                        <p><strong>Partisipasi Kompetisi:</strong> ${totalCompetitions > 0 ? `${totalCompetitions} kompetisi telah dilaksanakan` : 'Belum ada kompetisi'}</p>
                        <p><strong>Rekomendasi:</strong> ${lowScoreStudents > 0 ? 'Fokus pada bimbingan santri dengan poin rendah' : 'Pertahankan kualitas pembelajaran'}</p>
                    </div>
                </div>
                
                ${lowScoreStudents > 0 ? `
                <div style="margin-top: 30px;">
                    <h4 style="color: #f56565; margin-bottom: 20px;">⚠️ Santri Memerlukan Perhatian</h4>
                    <div class="student-grid">
                        ${studentsData.filter(s => s.points < 75).map(student => `
                            <div class="student-card danger">
                                <div class="student-name">${student.name}</div>
                                <div class="student-info">
                                    <span class="student-class">${student.class}</span>
                                    <span class="student-points danger">${student.points}</span>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
                ` : ''}
            `;
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            loadStudentData();
            
            // Close modals when clicking outside
            window.onclick = function(event) {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            };
        });

        // Auto-save data periodically
        setInterval(saveData, 30000); // Save every 30 seconds
    </script>
</body>
</html>