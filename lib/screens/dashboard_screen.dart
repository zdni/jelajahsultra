// ignore_for_file: avoid_print

import 'dart:ui';

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:wisatakuy/screens/category_screen.dart';
import 'package:wisatakuy/screens/detail_screen.dart';
import 'package:provider/provider.dart';

// screen
import 'search_screen.dart';

import '../models/wisata.dart';
import '../models/kategori.dart';

import '../providers/categories.dart';
import '../providers/tours.dart';

class DashboardScreen extends StatefulWidget {
  static const routeName = '/dashboard';
  const DashboardScreen({Key? key}) : super(key: key);

  @override
  State<DashboardScreen> createState() => _DashboardScreenState();
}

class _DashboardScreenState extends State<DashboardScreen> {
  bool isInit = true;
  
  @override
  void didChangeDependencies() {
    if (isInit) {
      Provider.of<Categories>(context).initialData();
      Provider.of<Tours>(context).initialData();
    }
    isInit = false;
    super.didChangeDependencies();
  }

  List<Wisata> tours = [];
  dynamic allTours;
  
  List<Kategori> categories = [];
  dynamic allCategories;
  
  Future<void> getData(Tours toursProvider, Categories categoriesProvider) async {
    getTours(toursProvider);
    getCategories(categoriesProvider);
  }

  Future<void> getTours(Tours toursProvider) async {
    if (toursProvider.totalWisata > 0 && allTours == null) {
      if(mounted) {
        setState(() {
          tours = toursProvider.allWisata;
          allTours = toursProvider;
        });
      }
    }
  }

  Future<void> getCategories(Categories categoriesProvider) async {
    if (categoriesProvider.totalKategori > 0 && allCategories == null) {
      if(mounted) {
        setState(() {
          categories = categoriesProvider.allKategori;
          allCategories = categoriesProvider;
        });
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    var width = MediaQuery.of(context).size.width;
    var urlPathUpload = 'https://jelajahsultra.info/uploads/wisata/';
    
    final allToursProvider = Provider.of<Tours>(context);
    final allCategoriesProvider = Provider.of<Categories>(context);

    return FutureBuilder(
      future: getData(allToursProvider, allCategoriesProvider),
      builder: (context, _) => Scaffold(
        resizeToAvoidBottomInset: false,
        body: Container(
          decoration: const BoxDecoration(
            color: Color.fromRGBO(249, 249, 249, 1.0),
          ),
          child: SafeArea(
            child: Column(
              children: [
                Row(
                  children: [
                    const SizedBox(width: 25.0),
                    Text(
                      'Beranda',
                      style: GoogleFonts.getFont(
                        'Quicksand',
                        color: const Color.fromRGBO(32, 32, 32, 1.0),
                        fontSize: 24.0,
                        fontWeight: FontWeight.w800,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 25.0),
                InkWell(
                  onTap: () => Navigator.pushNamed(context, SearchScreen.routeName),
                  child: Container(
                    padding: const EdgeInsets.symmetric(vertical: 10.0),
                    width: 200,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(8.0),
                      color: const Color.fromRGBO(3, 169, 251, 1.0)
                    ),
                    child: Row(
                      children: [
                        Expanded(
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Text(
                                'Jelajahi Tempat Wisata',
                                style: GoogleFonts.getFont(
                                  'Quicksand',
                                  fontWeight: FontWeight.bold,
                                  color: Colors.white
                                ),
                              ),
                            ],
                          ),
                        ),
                        const Icon(
                          Icons.search,
                          size: 18.0,
                          color: Colors.white,
                        ),
                        const SizedBox(width: 15.0),
                      ],
                    ),
                  ),
                ),
                const SizedBox(height: 10),
                (tours.isEmpty) 
                ? SizedBox(
                  width: width,
                  height: (width*9/16)+30,
                  child: const Center(
                    child: Text('Tidak ada data'),
                  ),
                )
                : Stack(
                  children: [
                    SizedBox(
                      width: width,
                      height: (width*9/16)+30,
                    ),
                    Container(
                      margin: const EdgeInsets.symmetric(horizontal: 25.0),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(15.0),
                        image: DecorationImage(
                          image: NetworkImage("$urlPathUpload${tours[0].image}"),
                          fit: BoxFit.cover
                        )
                      ),
                      width: width,
                      height: width*9/16,
                    ),
                    Positioned(
                      width: width-100,
                      left: 50,
                      top: (width*9/16)-30,
                      child: Center(
                        child: ClipRect(
                          child: BackdropFilter(
                            filter: ImageFilter.blur(sigmaX: 10.0, sigmaY: 10.0),
                            child: Container(
                              padding: const EdgeInsets.symmetric(horizontal: 15),
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(15.0),
                                color: const Color.fromRGBO(237, 237, 237, 0.38)
                              ),
                              width: width,
                              height: 60,
                              child: Row(
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
                                  Expanded(
                                    child: Column(
                                      mainAxisAlignment: MainAxisAlignment.center,
                                      crossAxisAlignment: CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          tours[0].nama,
                                          style: GoogleFonts.getFont(
                                            'Quicksand',
                                            fontWeight: FontWeight.bold,
                                            fontSize: 18.0
                                          ),
                                        ),
                                        Row(
                                          children: [
                                            Container(
                                              margin: const EdgeInsets.only(right: 5),
                                              width: 12,
                                              height: 12,
                                              child: const Icon(
                                                Icons.location_pin,
                                                size: 12,
                                              )
                                            ),
                                            Expanded(
                                              child: Text(
                                                maxLines: 1,
                                                tours[0].lokasi,
                                                style: GoogleFonts.getFont(
                                                  'Quicksand',
                                                ),
                                                overflow: TextOverflow.ellipsis,
                                              ),
                                            ),
                                          ],
                                        ),
                                      ],
                                    )
                                  ),
                                  InkWell(
                                    onTap: () => Navigator.pushNamed(
                                      context, 
                                      DetailScreen.routeName, 
                                      arguments: tours[0].id
                                    ),
                                    child: const SizedBox(
                                      width: 30,
                                      height: 30,
                                      child: Icon(Icons.chevron_right)
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                        ),
                      ),
                    )
                  ]
                ),
                const SizedBox(height: 25),
                Row(
                  children: [
                    const SizedBox(width: 25.0),
                    Text(
                      'Daftar Kategori',
                      style: GoogleFonts.getFont(
                        'Quicksand',
                        color: const Color.fromRGBO(32, 32, 32, 1.0),
                        fontSize: 16.0,
                        fontWeight: FontWeight.w800,
                      ),
                    )
                  ],
                ),
                const SizedBox(height: 10),
                (categories.isEmpty)
                ? const Center(
                  child: Text('Tidak ada data kategori'),
                )
                : Container(
                  margin: const EdgeInsets.only(left: 25.0),
                  height: 40,
                  child: ListView.builder(
                    scrollDirection: Axis.horizontal,
                    itemCount: categories.length,
                    itemBuilder: (context, index) {
                      return InkWell(
                        onTap: () => Navigator.pushNamed(context, CategoryScreen.routeName, arguments: categories[index].id),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Container(
                              margin: const EdgeInsets.only(right: 10.0),
                              height: 35,
                              decoration: BoxDecoration(
                                color: const Color.fromARGB(255, 210, 210, 210),
                                borderRadius: BorderRadius.circular(8.0)
                              ),
                              padding: const EdgeInsets.symmetric(
                                horizontal: 10.0,
                                vertical: 10.0, 
                              ),
                              child: Text(
                                categories[index].nama,
                                style: GoogleFonts.getFont(
                                  'Quicksand',
                                  fontSize: 12.0,
                                  fontWeight: FontWeight.bold,
                                  color: const Color.fromRGBO(32, 32, 32, 1.0),
                                ),
                              ),
                            ),
                          ],
                        ),
                      );
                    },
                  )
                ),
                const SizedBox(height: 25),
                Row(
                  children: [
                    const SizedBox(width: 25.0),
                    Text(
                      'Daftar Tempat Wisata Terbaru',
                      style: GoogleFonts.getFont(
                        'Quicksand',
                        color: const Color.fromRGBO(32, 32, 32, 1.0),
                        fontSize: 16.0,
                        fontWeight: FontWeight.w800,
                      ),
                    )
                  ],
                ),
                const SizedBox(height: 15),
                (tours.isEmpty)
                ? SizedBox(
                  width: width,
                  height: (width*9/16)+30,
                  child: const Center(
                    child: Text('Tidak ada data'),
                  ),
                )
                : Container(
                  height: 180,
                  margin: const EdgeInsets.only(left: 25.0),
                  child: ListView.builder(
                    scrollDirection: Axis.horizontal,
                    itemCount: tours.length,
                    itemBuilder: (context, index) {
                      return Stack(
                        children: [
                          Container(
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(15.0),
                              image: DecorationImage(
                                image: NetworkImage("$urlPathUpload${tours[index].image}"),
                                fit: BoxFit.cover
                              )
                            ),
                            width: 250,
                            height: 180,
                          ),
                          Align(
                            alignment: Alignment.bottomCenter,
                            child: Container(
                              margin: const EdgeInsets.only(right: 10),
                              padding: const EdgeInsets.symmetric(horizontal: 15),
                              decoration: const BoxDecoration(
                                borderRadius: BorderRadius.only(
                                  bottomLeft: Radius.circular(15.0),
                                  bottomRight: Radius.circular(15.0),
                                ),
                                color: Color.fromARGB(108, 58, 56, 56)
                              ),
                              width: 250,
                              height: 60,
                              child: Row(
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
                                  Expanded(
                                    child: Column(
                                      mainAxisAlignment: MainAxisAlignment.center,
                                      crossAxisAlignment: CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          tours[index].nama,
                                          style: GoogleFonts.getFont(
                                            'Quicksand',
                                            fontWeight: FontWeight.bold,
                                            fontSize: 18.0,
                                            color: Colors.white
                                          ),
                                        ),
                                        Row(
                                          children: [
                                            Container(
                                              margin: const EdgeInsets.only(right: 5),
                                              width: 12,
                                              height: 12,
                                              child: const Icon(
                                                Icons.location_pin,
                                                size: 12,
                                                color: Colors.white
                                              )
                                            ),
                                            Expanded(
                                              child: Text(
                                                tours[index].lokasi,
                                                maxLines: 1,
                                                style: GoogleFonts.getFont(
                                                  'Quicksand',
                                                  color: Colors.white
                                                ),
                                                overflow: TextOverflow.ellipsis,
                                              ),
                                            ),
                                          ],
                                        )
                                      ],
                                    )
                                  ),
                                  InkWell(
                                    onTap: () => Navigator.pushNamed(
                                      context, 
                                      DetailScreen.routeName, 
                                      arguments: tours[index].id
                                    ),
                                    child: const SizedBox(
                                      width: 30,
                                      height: 30,
                                      child: Icon(
                                        Icons.chevron_right, color: 
                                        Colors.white,
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            ),
                          ),
                        ],
                      );
                    },
                  ),
                ),
              ],
            ),
          ),
        )
      )
    );    
  }
}