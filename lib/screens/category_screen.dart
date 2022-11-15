// ignore_for_file: avoid_print

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart';

import '../models/kategori.dart';
import '../models/wisata.dart';
import '../providers/categories.dart';
import '../providers/tours.dart';

class CategoryScreen extends StatefulWidget {
  static const routeName = '/category';
  const CategoryScreen({Key? key}) : super(key: key);

  @override
  State<CategoryScreen> createState() => _CategoryScreenState();
}

class _CategoryScreenState extends State<CategoryScreen> {
  bool isInit = true;
  
  @override
  void didChangeDependencies() {
    final kategoriId = ModalRoute.of(context)?.settings.arguments;
    if (isInit) {
      Provider.of<Categories>(context).getKategori(kategoriId.toString());
      Provider.of<Tours>(context).getWisataByKategoriId(kategoriId.toString());
    }
    isInit = false;
    super.didChangeDependencies();
  }

  List<Wisata> tours = [];
  dynamic allTours;
  
  List<Kategori> categories = [];
  dynamic allCategories;

  Future<void> getData(Tours toursProvider, Categories categoriesProvider) async {
    await getTours(toursProvider);
    await getCategories(categoriesProvider);
  }

  Future<void> getTours(Tours toursProvider) async {
    if (toursProvider.totalWisata > 0 && allTours == null) {
      setState(() {
        tours = toursProvider.allWisata;
        allTours = toursProvider;
      });
    }
  }

  Future<void> getCategories(Categories categoriesProvider) async {
    if (categoriesProvider.totalKategori > 0 && allCategories == null) {
      setState(() {
        categories = categoriesProvider.allKategori;
        allCategories = categoriesProvider;
      });
    }
  }
  
  @override
  Widget build(BuildContext context) {
    var width = MediaQuery.of(context).size.width;
    var height = MediaQuery.of(context).size.height;
    var urlPathUpload = 'http://192.168.100.188/jelajahsultra/uploads/wisata/';

    final allToursProvider = Provider.of<Tours>(context);
    final allCategoriesProvider = Provider.of<Categories>(context);

    return FutureBuilder(
      future: getData(allToursProvider, allCategoriesProvider),
      builder: (context, _) {
        return Scaffold(
          resizeToAvoidBottomInset: false,
          body: (categories.isEmpty)
          ? Center(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text(
                    'Tidak ada Data Wisata',
                    style: GoogleFonts.getFont(
                      'Quicksand',
                      fontSize: 18.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  InkWell(
                    onTap: () => Navigator.pop(context),
                    child: Container(
                      padding: const EdgeInsets.symmetric(
                        horizontal: 40,
                        vertical: 8,
                      ),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(8.0),
                        color: const Color.fromRGBO(3, 169, 251, 1.0)
                      ),
                      child: Text(
                        'Kembali',
                        style: GoogleFonts.getFont(
                          'Quicksand',
                          fontSize: 18.0,
                          fontWeight: FontWeight.bold,
                          color: Colors.white
                        ),
                      ),
                    ),
                  )
                ],
              ),
            )
          : SafeArea(
            child: Column(
              children: [
                Row(
                  children: [
                    InkWell(
                      onTap: () => Navigator.pop(context),
                      child: const SizedBox(
                        width: 35,
                        height: 35,
                        child: Icon(Icons.chevron_left),
                      ),
                    ),
                    Expanded(
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Text(
                            categories[0].nama,
                            style: GoogleFonts.getFont(
                              'Quicksand',
                              fontSize: 20,
                              fontWeight: FontWeight.w900
                            ),
                          )
                        ],
                      ),
                    ),
                    const SizedBox(width: 35),
                  ],
                ),
              ],
            ),
          )
        );
      }
    );
  }
}