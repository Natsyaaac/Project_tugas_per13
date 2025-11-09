from faker import Faker
import random

# Inisialisasi Faker lokal Indonesia
fake = Faker("id_ID")

# === Daftar Data Tetap ===
jurusan_list = ["Teknik Informatika", "Sistem Informasi", "Teknik Elektro", "Manajemen", "Akuntansi"]
kelas_list = ["A", "B", "C", "D", "E"]
angkatan_list = [2021, 2022, 2023, 2024, 2025]

# Jumlah mahasiswa yang ingin dibuat
jumlah_data = int(input("Masukkan jumlah data mahasiswa yang ingin dibuat: "))

# === Mulai buat file output SQL ===
with open("mahasiswa_normalisasi_data.sql", "w", encoding="utf-8") as file:
    # ===== Tabel Jurusan =====
    file.write("-- Tabel Jurusan\n")
    file.write("INSERT INTO Jurusan (id_jurusan, nama_jurusan) VALUES\n")
    for i, jurusan in enumerate(jurusan_list, start=1):
        line_end = ",\n" if i < len(jurusan_list) else ";\n\n"
        file.write(f"({i}, '{jurusan}'){line_end}")

    # ===== Tabel Kelas =====
    file.write("-- Tabel Kelas\n")
    file.write("INSERT INTO Kelas (id_kelas, nama_kelas) VALUES\n")
    for i, kelas in enumerate(kelas_list, start=1):
        line_end = ",\n" if i < len(kelas_list) else ";\n\n"
        file.write(f"({i}, '{kelas}'){line_end}")

    # ===== Tabel Angkatan =====
    file.write("-- Tabel Angkatan\n")
    file.write("INSERT INTO Angkatan (id_angkatan, tahun_angkatan) VALUES\n")
    for i, tahun in enumerate(angkatan_list, start=1):
        line_end = ",\n" if i < len(angkatan_list) else ";\n\n"
        file.write(f"({i}, {tahun}){line_end}")

    # ===== Tabel Detail_Mhs =====
    file.write("-- Tabel Detail_Mhs\n")
    detail_data = []
    detail_id = 1
    for jurusan_id in range(1, len(jurusan_list) + 1):
        for kelas_id in range(1, len(kelas_list) + 1):
            angkatan_id = random.randint(1, len(angkatan_list))
            detail_data.append((detail_id, jurusan_id, kelas_id, angkatan_id))
            detail_id += 1

    file.write("INSERT INTO Detail_Mhs (id_detail, id_jurusan, id_kelas, id_angkatan) VALUES\n")
    for i, (id_detail, id_jurusan, id_kelas, id_angkatan) in enumerate(detail_data):
        line_end = ",\n" if i < len(detail_data) - 1 else ";\n\n"
        file.write(f"({id_detail}, {id_jurusan}, {id_kelas}, {id_angkatan}){line_end}")

    # ===== Tabel Mahasiswa =====
    file.write("-- Tabel Mahasiswa\n")
    file.write("INSERT INTO Mahasiswa (id, nama_mhs, nim_mhs, jenis_klm, usia_mhs, tanggal_lhr, id_detail) VALUES\n")

    counter_tahun = {}  # supaya NIM unik per angkatan

    for i in range(1, jumlah_data + 1):
        # Pilih detail acak
        id_detail = random.choice(detail_data)[0]

        # Ambil tahun angkatan dari id_detail
        angkatan_id = [d[3] for d in detail_data if d[0] == id_detail][0]
        tahun_angkatan = angkatan_list[angkatan_id - 1]

        # Buat NIM unik per tahun
        if tahun_angkatan not in counter_tahun:
            counter_tahun[tahun_angkatan] = 1
        else:
            counter_tahun[tahun_angkatan] += 1

        nim = f"{str(tahun_angkatan)[2:]}{counter_tahun[tahun_angkatan]:04d}"

        nama = fake.name()
        jenis_klm = random.choice(["Laki-laki", "Perempuan"])
        usia = random.randint(18, 24)
        tanggal_lhr = fake.date_of_birth(minimum_age=18, maximum_age=24)

        line_end = ",\n" if i < jumlah_data else ";\n"
        file.write(
            f"({i}, '{nama}', '{nim}', '{jenis_klm}', {usia}, '{tanggal_lhr}', {id_detail}){line_end}"
        )

print(f"✅ File 'mahasiswa_normalisasi_data.sql' berhasil dibuat dengan {jumlah_data} data mahasiswa acak tanpa NIM duplikat!")
