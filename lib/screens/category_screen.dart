// ignore_for_file: avoid_print

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:wisatakuy/screens/detail_screen.dart';
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
    if (isInit) {
      Provider.of<Categories>(context).initialData();
      Provider.of<Tours>(context).initialData();
    }
    isInit = false;
    super.didChangeDependencies();
  }

  String keyword = '';

  List<Wisata> tours = [];
  String recommendation = '';
  dynamic allTours;
  
  List<Kategori> categories = [];
  dynamic allCategories;

  Future<void> getData(Tours toursProvider, Categories categoriesProvider) async {
    await getTours(toursProvider);
    await getCategories(categoriesProvider);
  }

  Future<void> getTours(Tours toursProvider) async {
    if(mounted) {
      var kategoriId = ModalRoute.of(context)?.settings.arguments;
      await Provider.of<Tours>(context, listen: false).getWisataByKategoriId(kategoriId.toString());

      if (allTours == null) {
        if(mounted) {
          setState(() {
            tours = toursProvider.allWisata;
            allTours = toursProvider;
          });
        }
      }
    }
  }

  Future<void> getCategories(Categories categoriesProvider) async {
    if(mounted) {
      var kategoriId = ModalRoute.of(context)?.settings.arguments;
      await Provider.of<Categories>(context, listen: false).getKategori(kategoriId.toString());
      
      if (allCategories == null) {
        if(mounted) {
          setState(() {
            categories = categoriesProvider.allKategori;
            allCategories = categoriesProvider;
          });
        }
      }
    }
  }

  onchangeInput(string) {
    if(mounted) {
      setState(() {
        keyword = string;
      });
    }
  }

  search(string) async {
      var kategoriId = ModalRoute.of(context)?.settings.arguments;
      if(string.length > 0) {
        await Provider.of<Tours>(context, listen: false).notsonaive(string, kategoriId.toString());

        if(mounted) {
          setState(() {
            tours = allTours.allWisata;
          });
        }
        Fluttertoast.showToast(
          msg: "Waktu Pencarian Not So Naive: ${allTours.executionTime} ms",
          toastLength: Toast.LENGTH_LONG,
          gravity: ToastGravity.BOTTOM,
          timeInSecForIosWeb: 2,
          backgroundColor: const Color.fromRGBO(8, 129, 163, 1.0),
          textColor: Colors.white,
          fontSize: 14,
        );
      } else {
        await Provider.of<Tours>(context, listen: false).getWisataByKategoriId(kategoriId.toString());
        if(mounted) {
          setState(() {
            tours = allTours.allWisata;
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
                    onTap: () => Navigator.of(context, rootNavigator: true).pop(),
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
              child: Container(
                padding: const EdgeInsets.symmetric(horizontal: 25.0),
                child: Column(
                  children: [
                    Row(
                      children: [
                        InkWell(
                          onTap: () => Navigator.of(context, rootNavigator: true).pop(),
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
                    const SizedBox(height: 15),
                    Row(
                    children: [
                      Expanded(
                        child: TextField(
                          onChanged: (text) {
                            onchangeInput(text);
                            if( text.length > 1 ) {
                              search(keyword);
                            }
                          },
                          decoration: const InputDecoration(
                            hintText: 'Jelajahi...',
                            focusColor: Color.fromRGBO(63, 89, 125, 1.0),
                            contentPadding: EdgeInsets.symmetric(horizontal: 20.0),
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.all(
                                Radius.circular(15),
                              ),
                            ),
                          ),
                        ),
                      ),
                      const SizedBox(width: 10),
                      InkWell(
                        onTap: () {
                          if( keyword == '' ) {
                            Fluttertoast.showToast(
                              msg: "Tidak ada keyword pencarian",
                              toastLength: Toast.LENGTH_LONG,
                              gravity: ToastGravity.BOTTOM,
                              timeInSecForIosWeb: 2,
                              backgroundColor: const Color.fromRGBO(8, 129, 163, 1.0),
                              textColor: Colors.white,
                              fontSize: 14,
                            );
                          }
                          search(keyword);
                        },
                        child: Container(
                          width: 45,
                          height: 45,
                          decoration: const BoxDecoration(
                            color: Color.fromRGBO(3, 169, 251, 1.0),
                            borderRadius: BorderRadius.all(
                                Radius.circular(15),
                              ),
                          ),
                          child: const Icon(
                            Icons.search,
                            color: Colors.white,
                            size: 24,
                          ),
                        ),
                      )
                    ],
                  ),
                  const SizedBox(height: 15),
                    Expanded(
                      child: (tours.isEmpty) 
                        ? ( recommendation == '' ) ? Center(
                          child: Text('Tidak ada Data Wisata pada kategori ${categories[0].nama}'),
                        ) : Center(
                          child: Text(
                            'Mungkin yang Anda maksud adalah `$recommendation`',
                            style: GoogleFonts.getFont(
                              'Quicksand',
                              fontSize: 20,
                              fontWeight: FontWeight.w500
                            ),
                            textAlign: TextAlign.center,
                          ),
                        )
                        : ListView.builder(
                          itemCount: tours.length,
                          itemBuilder: (context, index) {
                            return Stack(
                              children: [
                                Container(
                                  margin: const EdgeInsets.only(bottom: 15),
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(15.0),
                                    image: DecorationImage(
                                      image: NetworkImage("$urlPathUpload${tours[index].image}"),
                                      fit: BoxFit.cover
                                    )
                                  ),
                                  width: width,
                                  height: width/2,
                                ),
                                Container(
                                  width: width,
                                  height: width/2,
                                  padding: EdgeInsets.only(top: (width/2)-60),
                                  child: Container(
                                    padding: const EdgeInsets.symmetric(horizontal: 15),
                                    decoration: const BoxDecoration(
                                      borderRadius: BorderRadius.only(
                                        bottomLeft: Radius.circular(15.0),
                                        bottomRight: Radius.circular(15.0),
                                      ),
                                      color: Color.fromARGB(108, 58, 56, 56)
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
                        )
                    )
                  ],
                ),
              )
            )
        );
      }
    );
  }
}