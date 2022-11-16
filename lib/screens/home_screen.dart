import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:wisatakuy/screens/about_screen.dart';
import 'package:wisatakuy/screens/dashboard_screen.dart';

class HomeScreen extends StatelessWidget {
  static const routeName = '/';
  const HomeScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      body: Container(
        width: double.infinity,
        decoration: const BoxDecoration(
          image: DecorationImage(
            image: AssetImage('assets/images/bg.png'),
            fit: BoxFit.cover
          ),
        ),
        child: Column(
          children: [
            const SizedBox(height: 25),
            Text(
              'WisataKuy',
              style: GoogleFonts.getFont(
                'Quicksand',
                color: Colors.white,
                fontWeight: FontWeight.w700,
                fontSize: 20,
              ),
            ),
            Expanded(child: Container()),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Expanded(flex: 1, child: Container()),
                Expanded(
                  flex: 10,
                  child: 
                    Text(
                      'Jelajahi Keindahan SULTRA',
                      style: GoogleFonts.getFont(
                        'Quicksand',
                        color: Colors.white,
                        fontWeight: FontWeight.w900,
                        fontSize: 54,
                      ),
                    ),
                ),
                Expanded(flex: 1, child: Container()),
              ],
            ),
            const SizedBox(height: 35),
            InkWell(
              onTap: () => Navigator.pushNamed(context, DashboardScreen.routeName),
              child: Container(
                padding: const EdgeInsets.symmetric(vertical: 10.0),
                width: 130.0,
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
                            'Jelajahi',
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
                      Icons.arrow_right_alt_sharp,
                      size: 18.0,
                      color: Colors.white,
                    ),
                    const SizedBox(width: 15.0),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 10),
            Text(
              'Develop by Rahma Alfarisna',
              style: GoogleFonts.getFont(
                'Quicksand',
                color: Colors.white,
                fontWeight: FontWeight.w500,
                fontSize: 12,
              ),
            ),
            const SizedBox(height: 8),
            InkWell(
              onTap: () => Navigator.pushNamed(context, AboutScreen.routeName),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  const SizedBox(
                    width: 24,
                    height: 24,
                    child: Icon(
                      Icons.info_outline_rounded,
                      color: Colors.white,
                      size: 18,
                    ),
                  ),
                  const SizedBox(width: 8),
                  Text(
                    'Tentang Aplikasi',
                    style: GoogleFonts.getFont(
                      'Quicksand',
                      fontSize: 14.0,
                      color: Colors.white,
                    ),
                  ),
                ]
              ),
            ),
            const SizedBox(height: 25),
          ],
        ),
      )
    );
  }
}