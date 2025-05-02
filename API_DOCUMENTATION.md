# Dokumentasi API Sistem Gudang

## Endpoint Autentikasi

### Login
- **Method**: POST
- **URL**: `/api/login`
- **Request Body**:
  ```json
  {
    "email": "user@example.com",
    "password": "password123"
  }
  ```
- **Response Success**:
  ```json
  {
    "token": "access_token",
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@example.com"
    }
  }
  ```

### Register
- **Method**: POST
- **URL**: `/api/register`
- **Request Body**:
  ```json
  {
    "name": "User Baru",
    "email": "newuser@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }
  ```
- **Response Success**:
  ```json
  {
    "token": "access_token",
    "user": {
      "id": 2,
      "name": "User Baru",
      "email": "newuser@example.com"
    }
  }
  ```

### Logout
- **Method**: POST
- **URL**: `/api/logout`
- **Headers**:
  - `Authorization: Bearer access_token`
- **Response Success**:
  ```json
  {
    "message": "Successfully logged out"
  }
  ```

## Endpoint Barang

### Get All Barang
- **Method**: GET
- **URL**: `/api/barang`
- **Response Success**:
  ```json
  [
    {
      "id": 1,
      "nama_barang": "Barang Contoh",
      "kode": "BRG001",
      "kategori": "Elektronik",
      "lokasi": "Rak A1",
      "deskripsi": "Deskripsi barang contoh",
      "stok": 100
    }
  ]
  ```

### Create Barang
- **Method**: POST
- **URL**: `/api/barang`
- **Request Body**:
  ```json
  {
    "nama_barang": "Barang Baru",
    "kode": "BRG002",
    "kategori": "Elektronik",
    "lokasi": "Rak B2",
    "deskripsi": "Deskripsi barang baru",
    "stok": 50
  }
  ```
- **Response Success**:
  ```json
  {
    "id": 2,
    "nama_barang": "Barang Baru",
    "kode": "BRG002",
    "kategori": "Elektronik",
    "lokasi": "Rak B2",
    "deskripsi": "Deskripsi barang baru",
    "stok": 50
  }
  ```

### Get Detail Barang
- **Method**: GET
- **URL**: `/api/barang/{id}`
- **Response Success**:
  ```json
  {
    "id": 1,
    "nama_barang": "Barang Contoh",
    "kode": "BRG001",
    "kategori": "Elektronik",
    "lokasi": "Rak A1",
    "deskripsi": "Deskripsi barang contoh",
    "stok": 100
  }
  ```

### Update Barang
- **Method**: PUT/PATCH
- **URL**: `/api/barang/{id}`
- **Request Body**:
  ```json
  {
    "nama_barang": "Barang Contoh Updated",
    "stok": 150
  }
  ```
- **Response Success**:
  ```json
  {
    "id": 1,
    "nama_barang": "Barang Contoh Updated",
    "kode": "BRG001",
    "kategori": "Elektronik",
    "lokasi": "Rak A1",
    "deskripsi": "Deskripsi barang contoh",
    "stok": 150
  }
  ```

### Delete Barang
- **Method**: DELETE
- **URL**: `/api/barang/{id}`
- **Response Success**:
  ```json
  {
    "message": "Barang deleted successfully"
  }
  ```

## Endpoint Mutasi

### Get All Mutasi
- **Method**: GET
- **URL**: `/api/mutasi`
- **Response Success**:
  ```json
  [
    {
      "id": 1,
      "user_id": 1,
      "barang_id": 1,
      "tanggal": "2023-01-01",
      "jenis_mutasi": "masuk",
      "jumlah": 10,
      "keterangan": "Penambahan stok awal"
    }
  ]
  ```

### Create Mutasi
- **Method**: POST
- **URL**: `/api/mutasi`
- **Request Body**:
  ```json
  {
    "barang_id": 1,
    "tanggal": "2023-01-02",
    "jenis_mutasi": "keluar",
    "jumlah": 5,
    "keterangan": "Pengambilan barang"
  }
  ```
- **Response Success**:
  ```json
  {
    "id": 2,
    "user_id": 1,
    "barang_id": 1,
    "tanggal": "2023-01-02",
    "jenis_mutasi": "keluar",
    "jumlah": 5,
    "keterangan": "Pengambilan barang"
  }
  ```

### Get Detail Mutasi
- **Method**: GET
- **URL**: `/api/mutasi/{id}`
- **Response Success**:
  ```json
  {
    "id": 1,
    "user_id": 1,
    "barang_id": 1,
    "tanggal": "2023-01-01",
    "jenis_mutasi": "masuk",
    "jumlah": 10,
    "keterangan": "Penambahan stok awal"
  }
  ```

### Update Mutasi
- **Method**: PUT/PATCH
- **URL**: `/api/mutasi/{id}`
- **Request Body**:
  ```json
  {
    "jumlah": 15,
    "keterangan": "Penambahan stok revisi"
  }
  ```
- **Response Success**:
  ```json
  {
    "id": 1,
    "user_id": 1,
    "barang_id": 1,
    "tanggal": "2023-01-01",
    "jenis_mutasi": "masuk",
    "jumlah": 15,
    "keterangan": "Penambahan stok revisi"
  }
  ```

### Delete Mutasi
- **Method**: DELETE
- **URL**: `/api/mutasi/{id}`
- **Response Success**:
  ```json
  {
    "message": "Mutasi deleted successfully"
  }
  ```

### Get Mutasi by Barang
- **Method**: GET
- **URL**: `/api/mutasi/barang/{barang_id}`
- **Response Success**:
  ```json
  [
    {
      "id": 1,
      "user_id": 1,
      "barang_id": 1,
      "tanggal": "2023-01-01",
      "jenis_mutasi": "masuk",
      "jumlah": 10,
      "keterangan": "Penambahan stok awal"
    }
  ]
  ```

### Get Mutasi by User
- **Method**: GET
- **URL**: `/api/mutasi/user/history`
- **Response Success**:
  ```json
  [
    {
      "id": 1,
      "user_id": 1,
      "barang_id": 1,
      "tanggal": "2023-01-01",
      "jenis_mutasi": "masuk",
      "jumlah": 10,
      "keterangan": "Penambahan stok awal"
    }
  ]
  ```