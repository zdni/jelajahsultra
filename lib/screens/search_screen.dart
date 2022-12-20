// ignore_for_file: avoid_print

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:wisatakuy/models/wisata.dart';
import 'package:provider/provider.dart';

import '../providers/tours.dart';
import 'detail_screen.dart';

class SearchScreen extends StatefulWidget {
  static const routeName = '/search';
  const SearchScreen({Key? key}) : super(key: key);

  @override
  State<SearchScreen> createState() => _SearchScreenState();
}

class _SearchScreenState extends State<SearchScreen> {
  bool isInit = true;

  @override
  void didChangeDependencies() {
    if (isInit) {
      Provider.of<Tours>(context).initialData();
      
    }
    isInit = false;
    super.didChangeDependencies();
  }

  String keyword = '';

  List<Wisata> tours = [];
  dynamic allTours;

  Future<void> getTours(Tours toursProvider) async {
    if(toursProvider.totalWisata > 0 && allTours == null) {
      if(mounted) {
        setState(() {
          tours = toursProvider.allWisata;
          allTours = toursProvider;
        });
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
    if(string.length > 0) {
      await Provider.of<Tours>(context, listen: false).notsonaive(string, '');
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
      await Provider.of<Tours>(context, listen: false).initialData();
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

    return FutureBuilder(
      future: getTours(allToursProvider),
      builder: (context, _) {
        return Scaffold(
          resizeToAvoidBottomInset: false,
          body: SafeArea(
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
                          children: [
                            Text(
                              'Jelajahi SULTRA',
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
                  const SizedBox(height: 25),
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
                            Icons.refresh_rounded,
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
                      ? const Center(
                        child: Text('Tidak ada Data Wisata'),
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
                        }
                      )
                  )
                ],
              )
            )
          )
        );
      }
    );
  }
}