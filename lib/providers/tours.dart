// ignore_for_file: depend_on_referenced_packages, avoid_print

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../models/wisata.dart';

class Tours with ChangeNotifier {
  var urlAPI = 'http://192.168.100.188/jelajah.sultra/api/';
  static List<Wisata> _allWisata = [];

  List<Wisata> get allWisata => _allWisata;

  int get totalWisata => _allWisata.length;

  Future<void> initialData() async {
    Uri url = Uri.parse(
        '${urlAPI}ambilSemuaWisata');

    var resultGetData = await http.get(url);

    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;

    _allWisata = [];
    
    var arrayLength = dataResponse["data"]?.length ?? 0;

    for (var i = 0; i < arrayLength; i++) {
      var data = dataResponse["data"]?[i];
      _allWisata.add(
        Wisata(
          id: int.parse(data?['id']), 
          kategoriId: int.parse(data?['kategori_id']), 
          nama: data?['nama'], 
          jamOperasional: data?['jam_operasional'], 
          fasilitas: data?['fasilitas'], 
          lokasi: data?['lokasi'], 
          keterangan: data?['keterangan'], 
          image: data?['image'],
          kategori: data?['kategori']
        )
      );
    }
    notifyListeners();
  }

  Future<void> getWisata(String wisataId) async {
    Uri url = Uri.parse('${urlAPI}ambilWisata/$wisataId');

    var resultGetData = await http.get(url);
    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;
    
    var arrayLength = dataResponse['data']?.length ?? 0;

    _allWisata = [];

    for (var i = 0; i < arrayLength; i++) {
      var data = dataResponse["data"]?[i];
      _allWisata.add(
        Wisata(
          id: int.parse(data?['id']), 
          kategoriId: int.parse(data?['kategori_id']), 
          nama: data?['nama'], 
          jamOperasional: data?['jam_operasional'], 
          fasilitas: data?['fasilitas'], 
          lokasi: data?['lokasi'], 
          keterangan: data?['keterangan'], 
          image: data?['image'],
          kategori: data?['kategori']
        )
      );
    }
  }

  Future<void> getWisataByKategoriId(String kategoriId) async {
    Uri url = Uri.parse('${urlAPI}ambilWisataBerdasarkanKategori/$kategoriId');
    
    var resultGetData = await http.get(url);
    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;
    
    var arrayLength = dataResponse['data']?.length ?? 0;

    _allWisata = [];

    for (var i = 0; i < arrayLength; i++) {
      var data = dataResponse["data"]?[i];
      _allWisata.add(
        Wisata(
          id: int.parse(data?['id']), 
          kategoriId: int.parse(data?['kategori_id']), 
          nama: data?['nama'], 
          jamOperasional: data?['jam_operasional'], 
          fasilitas: data?['fasilitas'], 
          lokasi: data?['lokasi'], 
          keterangan: data?['keterangan'], 
          image: data?['image'],
          kategori: data?['kategori']
        )
      );
    }
  }

  Future<void> notsonaive(String keyword, String kategoriId) async {
    Uri url = Uri.parse('${urlAPI}notsonaive?keyword=$keyword&kategori=$kategoriId');
    // Uri url = Uri.parse('${urlAPI}notsonaive?keyword=toro&kategori=');
    print(url);
    
    var resultGetData = await http.get(url);
    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;
    print(dataResponse);
    var arrayLength = dataResponse['data']?.length ?? 0;
    _allWisata = [];

    for (var i = 0; i < arrayLength; i++) {
      var data = dataResponse["data"]?[i];
      _allWisata.add(
        Wisata(
          id: int.parse(data?['id']), 
          kategoriId: int.parse(data?['kategori_id']), 
          nama: data?['nama'], 
          jamOperasional: data?['jam_operasional'], 
          fasilitas: data?['fasilitas'], 
          lokasi: data?['lokasi'], 
          keterangan: data?['keterangan'], 
          image: data?['image'],
          kategori: data?['kategori']
        )
      );
    }
  }
}
