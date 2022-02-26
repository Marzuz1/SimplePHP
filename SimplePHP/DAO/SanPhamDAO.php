<?php
require_once "connect.php";


class SanPhamDAO 
{
    public static function LayDSSP()
    {
        $sql = "SELECT sp.*, TenLoaiSP FROM SanPham sp INNER JOIN LoaiSanPham lsp ON sp.MaLoaiSP = lsp.MaLoaiSP ORDER BY MaSP ASC";
        return ExecuteSelectQuery($sql);
    }
   public static function XoaSP($masp)
   {
       $sql = "UPDATE SanPham SET TrangThai = 0 WHERE MaSP = ?";
       $dataType = "s";
       $params = array($masp);
       return ExecuteNonQuery($sql, $dataType, $params);
   }
   public static function SuaSP($MaSP, $TenSP, $thongTin, $GiaTien, $soLuongTonKho, $MaLoaiSP, $AnhMinhHoa)
   {
       $sql = "UPDATE SanPham SET TenSP = ?, ThongTin = ?, GiaTien = ?, SoLuongTonKho = ?, MaLoaiSP = ?, AnhMinhHoa = ? WHERE MaSP = ?";
        $dataType = "ssiissis";
        $params = array($TenSP, $thongTin, $GiaTien, $soLuongTonKho, $MaLoaiSP, $AnhMinhHoa, $MaSP);
        return ExecuteNonQuery($sql, $dataType, $params);
   }
   public static function LayTTSP($MaSP)
   {
       $sql = "SELECT sp.*, TenLoaiSP FROM SanPham sp join LoaiSanPham lsp ON sp.MaLoaiSP = lsp.MaLoaiSP WHERE MaSP = ?";
       $dataType = "s";
       $params = array($MaSP);
       return ExecuteSelectQuery($sql, $dataType, $params)->fetch_assoc();
   }
   public static function KiemTraMaLoaiSPTonTai($MaLoaiSP)
   {
       $sql = "SELECT COUNT(*) AS SoLuong FROM LoaiSanPham WHERE MaLoaiSP = ?";
       $dataType = "s";
       $params = array($MaLoaiSP);
       return ExecuteSelectQuery($sql, $dataType, $params)->fetch_assoc()["SoLuong"] > 0;
   }

   public static function LayDSLoaiSP()
   {
       $sql = "SELECT * FROM LoaiSanPham";
       return ExecuteSelectQuery($sql);
   }
   public static function ThemSP($MaSP, $TenSP, $ThongTin, $GiaTien, $SoLuongTonKho, $MaLoaiSP, $AnhMinhHoa)
   {
       $sql = "INSERT INTO SanPham (MaSP, TenSP, ThongTin, GiaTien, SoLuongTonKho, MaLoaiSP, AnhMinhHoa) VALUES (?, ?, ?, ?, ?, ?, ?)";
       $dataType = "sssiiss";
       $params = array($MaSP, $TenSP, $ThongTin, $GiaTien, $SoLuongTonKho, $MaLoaiSP, $AnhMinhHoa);
       return ExecuteNonQuery($sql, $dataType, $params) == 1;
   }
   public static function KiemTraMaSPTonTai($MaSP)
   {
       $sql = "SELECT COUNT(*) AS SoLuong FROM SanPham WHERE MaSP = ?";
       $dataType = "s";
       $params = array($MaSP);
       return ExecuteSelectQuery($sql, $dataType, $params)->fetch_assoc()["SoLuong"];
   }
}