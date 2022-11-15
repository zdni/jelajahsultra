// ignore_for_file: depend_on_referenced_packages, avoid_print

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../models/kategori.dart';

class Categories with ChangeNotifier {
  var urlAPI = 'http://192.168.100.188/jelajahsultra/api/';
  static List<Kategori> _allKategori = [];

  List<Kategori> get allKategori => _allKategori;

  int get totalKategori => _allKategori.length;

  Future<void> initialData() async {
    Uri url = Uri.parse(
        '${urlAPI}ambilSemuaKategori');

    var resultGetData = await http.get(url);

    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;

    _allKategori = [];

    var arrayLength = dataResponse["data"]?.length ?? 0;

    for (var i = 0; i < arrayLength; i++) {
      var data = dataResponse["data"]?[i];
      
      _allKategori.add(
        Kategori(
          id: int.parse(data?['id']), 
          nama: data?['nama'], 
          deskripsi: data?['deskripsi']
        )
      );
    }
    notifyListeners();
  }

  Future<void> getKategori(String kategoriId) async {
    Uri url = Uri.parse('${urlAPI}ambilKategori/$kategoriId');

    var resultGetData = await http.get(url);
    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;
    
    var arrayLength = dataResponse['data']?.length ?? 0;

    _allKategori = [];

    for (var i = 0; i < arrayLength; i++) {
      var data = dataResponse["data"]?[i];
      _allKategori.add(
        Kategori(
          id: int.parse(data?['id']), 
          nama: data?['nama'], 
          deskripsi: data?['deskripsi']
        )
      );
    }
  }
}
