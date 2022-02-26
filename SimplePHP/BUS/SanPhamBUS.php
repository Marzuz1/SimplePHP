<?php
require "DAO\SanPhamDAO.php";

class SanPhamBUS 
{
    public static function LayDSSP()
    {
      return SanPhamDAO::LayDSSP();
    }
    public static function XoaSP($masp)
    {
      return SanPhamDAO::XoaSP($masp);
    }
    public static function LayTTSP($MaSP)
    {
      return SanPhamDAO::LayTTSP($MaSP);
    }
    public static function KiemTraMaLoaiSPTonTai($maLoaiSP)
    {
        return SanPhamDAO::KiemTraMaLoaiSPTonTai($maLoaiSP);
    }

    public static function LayDSLoaiSP()
    {
        return SanPhamDAO::LayDSLoaiSP();
    }
    public static function ThemSP($MaSP, $TenSP, $ThongTin, $GiaTien, $SoLuongTonKho, $MaLoaiSP, $AnhMinhHoa)
    {
        if (!SanPhamDAO::KiemTraMaSPTonTai($MaSP)) {
            return SanPhamDAO::ThemSP($MaSP, $TenSP, $ThongTin, $GiaTien, $SoLuongTonKho, $MaLoaiSP, $AnhMinhHoa);
        }
        return false;
    }
}