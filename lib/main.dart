import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

// screen
import 'screens/about_screen.dart';
import 'screens/category_screen.dart';
import 'screens/dashboard_screen.dart';
import 'screens/detail_screen.dart';
import 'screens/home_screen.dart';
import 'screens/search_screen.dart';

// provider
import '../providers/categories.dart';
import '../providers/tours.dart';

void main() => runApp(const MyApp());

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (context) => Tours()),
        ChangeNotifierProvider(create: (context) => Categories()),
      ],
        child: MaterialApp(
        debugShowCheckedModeBanner: false,
        title: 'Jelajah Sultra',
        initialRoute: HomeScreen.routeName,
        routes: {
          AboutScreen.routeName: (context) => const AboutScreen(),
          CategoryScreen.routeName: (context) => const CategoryScreen(),
          DashboardScreen.routeName: (context) => const DashboardScreen(),
          DetailScreen.routeName: (context) => const DetailScreen(),
          HomeScreen.routeName: (context) => const HomeScreen(),
          SearchScreen.routeName: (context) => const SearchScreen(),
        },
      ),
    );
  }
}