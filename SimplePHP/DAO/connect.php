<?php
$conn;

// Hàm OpenConnection()
// Mục đích: Mở kết nối tới CSDL.
// Tham số: Không có.
// Trả về: Kết nối vừa tạo.
function OpenConnection()
{
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dbName = "de1";
    global $conn;
    $conn = new mysqli($serverName, $username, $password, $dbName);
    $conn->set_charset("utf8");
    if ($conn->connect_error) {
        error_log("Kết nối tới CSDL $serverName/$dbName bằng tài khoản $username thất bại. Lỗi: " . $conn->connect_error);
        exit();
    }
    return $conn;
}

// Hàm ExecuteSelectQuery()
// Mục đích: Thực thi truy vấn SELECT.
// Tham số: $sql là prepared statement.
//          $dataType là danh sách kiểu dữ liệu cho parameter.
//          $params là mảng chứa các tham số theo thứ tự.
// Trả về: Bảng kết quả nếu truy vấn thành công. False nếu truy vấn thất bại.
function ExecuteSelectQuery($sql, $dataType = null, $params = null)
{
    global $conn;
    $conn = OpenConnection();
    $stmt = $conn->prepare($sql);
    if ($dataType && $params) {
        $stmt->bind_param($dataType, ...$params);
    }
    if ($stmt->execute()) {
        $result = $stmt->get_result();
    } else {
        error_log("Truy vấn thất bại. Lỗi: " . $stmt->error);
        $result = false;
    }
    $conn->close();
    return $result;
}

// Hàm ExecuteNonQuery()
// Mục đích: Thực thi truy vấn INSERT, UPDATE, DELETE.
// Tham số: $sql là prepared statement.
//          $dataType là danh sách kiểu dữ liệu cho parameter.
//          $params là mảng chứa các tham số theo thứ tự.
// Trả về: Số dòng bị ảnh hưởng nếu truy vấn thành công. False nếu truy vấn thất bại.
function ExecuteNonQuery($sql, $dataType = null, $params = null)
{
    global $conn;
    $conn = OpenConnection();
    $stmt = $conn->prepare($sql);
    if ($dataType && $params) {
        $stmt->bind_param($dataType, ...$params);
    }
    if ($stmt->execute()) {
        $result = $stmt->affected_rows;
    } else {
        error_log("Truy vấn thất bại. Lỗi: " . $stmt->error);
        $result = false;
    }
    $conn->close();
    return $result;
}