// ignore_for_file: depend_on_referenced_packages, avoid_print

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../models/wisata.dart';

class Tours with ChangeNotifier {
  var urlAPI = 'https://jelajahsultra.info/api/';
  static List<Wisata> _allWisata = [];
  static List<Wisata> _allWisataByRating = [];
  static bool updateData = false;
  String executionTime = '';
  String recommendation = '';

  List<Wisata> get allWisata => _allWisata;
  List<Wisata> get allWisataByRating => _allWisataByRating;

  int get totalWisata => _allWisata.length;

  Wisata selectById(int id) => _allWisata.firstWhere((element) => element.id == id);

  Future<void> initialData() async {
    Uri url = Uri.parse('${urlAPI}ambilSemuaWisata');
    Uri urlByRating = Uri.parse('${urlAPI}ambilSemuaWisataBerdasarkanRating');

    var resultGetData = await http.get(url);
    var resultGetDataByRating = await http.get(urlByRating);

    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;
    var dataResponseByRating = json.decode(resultGetDataByRating.body) as Map<String, dynamic>;

    _allWisata = [];
    _allWisataByRating = [];
    
    var arrayLength = dataResponse["data"]?.length ?? 0;
    var arrayByRatingLength = dataResponseByRating["data"]?.length ?? 0;

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
          kategori: data?['kategori'],
          map: data?['map'],
          rating: data?['rating'],
        )
      );
    }

    for (var i = 0; i < arrayByRatingLength; i++) {
      var data = dataResponseByRating["data"]?[i];
      _allWisataByRating.add(
        Wisata(
          id: int.parse(data?['id']), 
          kategoriId: int.parse(data?['kategori_id']), 
          nama: data?['nama'], 
          jamOperasional: data?['jam_operasional'], 
          fasilitas: data?['fasilitas'], 
          lokasi: data?['lokasi'], 
          keterangan: data?['keterangan'], 
          image: data?['image'],
          kategori: data?['kategori'],
          map: data?['map'],
          rating: data?['rating'],
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
          kategori: data?['kategori'],
          map: data?['map'],
          rating: data?['rating'],
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
          map: data?['map'],
          rating: data?['rating'],
          kategori: data?['kategori']
        )
      );
    }
  }

  Future<void> notsonaive(String keyword, String kategoriId) async {
    Uri url = Uri.parse('${urlAPI}notsonaive?keyword=$keyword&kategori=$kategoriId');
    // Uri url = Uri.parse('${urlAPI}notsonaive?keyword=toro&kategori=');
    
    var resultGetData = await http.get(url);
    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;
    var arrayLength = dataResponse['data']?.length ?? 0;
    
    _allWisata = [];
    executionTime = dataResponse['execution_time'].toString();

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
          map: data?['map'],
          rating: data?['rating'],
          kategori: data?['kategori']
        )
      );
    }

    if( arrayLength == 0) {
      recommendation = dataResponse['rekomendasi'];
    }
  }

  Future<void> likeWisata(int id) async {
    Uri url = Uri.parse('${urlAPI}likeWisata/$id');
    
    var resultGetData = await http.get(url);
    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;
    var arrayLength = dataResponse['data']?.length ?? 0;

    if( arrayLength > 0 ) {
      updateData = true;
    }
  }

  Future<void> dislikeWisata(int id) async {
    Uri url = Uri.parse('${urlAPI}dislikeWisata/$id');
    
    var resultGetData = await http.get(url);
    var dataResponse = json.decode(resultGetData.body) as Map<String, dynamic>;
    var arrayLength = dataResponse['data']?.length ?? 0;

    if( arrayLength > 0 ) {
      updateData = true;
    }
  }
}
